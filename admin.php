<?php
session_start();
require 'php/db.php';

if (isset($_SESSION['id']) && $_SESSION['idrole'] > 1) {
  $currentUserId = $_SESSION['id'];
  $currentUserLogin = $_SESSION['login'];
  $currentUserPhoto = $_SESSION['photo'];
  $currentUserEmail = $_SESSION['email'];
  $currentUserRole = $_SESSION['idrole'];

  $result = $mysql->query("SELECT Photo FROM user WHERE Id = $currentUserId");
  $userData = $result->fetch_assoc();
  $userPhoto = $userData['Photo'];

  $requests = $mysql->query("SELECT * FROM request WHERE isAccepted = 0");

  $stmt = $mysql->prepare('SELECT orders.*, order_statuses.name AS status_name, order_statuses.color AS status_color FROM `orders` JOIN order_statuses on orders.status_id = order_statuses.id WHERE status_id != 1 ORDER BY orders.id DESC');
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result) {
    $orders = $result->fetch_all(MYSQLI_ASSOC);
  }
  $stmt->close();
  $stmt = $mysql->query("SELECT * FROM order_statuses");
  $order_statuses = $stmt->fetch_all(MYSQLI_ASSOC);
  $stmt->close();
} else header("Location: /");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="./js/drop-down-menu.js" defer></script>
  <script src="./js/tabs.js" defer></script>
  <script src="./js/burger.js" defer></script>
  <title>KEMII</title>
</head>

<body>

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>

  <!-- PROFILE START -->

  <div class="profile">
    <div class="container">
      <div class="profile-content">
        <div class="profile-text">
          <h1 class="profile-title">
            Админ-панель
          </h1>
          <div class="profile-info">
            <div class="profile-pfp">
              <?php if ($_SESSION['photo']) { ?>
                <img class="profile-pfp-inner" src="img/avatars/<?= $_SESSION['photo'] ?>" alt="User Photo">
              <?php } else { ?>
                <img class="profile-pfp-inner" src="./img/main.png" alt="User Photo">
              <?php } ?>
            </div>
            <div class="profile-info-text">
              <p class="profile-login">
                <?= $currentUserLogin ?>
              </p>
              <p class="profile-email">
                <?= $currentUserEmail ?>
              </p>
              <a href="profile-edit.php" class="profile-edit">
                Редактировать профиль
              </a>
            </div>
          </div>
        </div>

        <div class="tab" id="tab-1">
          <div class="tab-nav">
            <button type="button" class="tab-btn" data-tab-name="Заявки">Заявки</button>
            <button type="button" class="tab-btn" data-tab-name="заказы">заказы</button>
          </div>
          <div class="tab-content">
            <div class="tab-pane" data-tab-name="Заявки">
              <div class="card-inner">
                <?php
                while ($row = $requests->fetch_assoc()) {
                  $formattedId = sprintf("%03d", $row['Id']);
                ?>
                  <form method="post" class="admin-order" action="php/accept_request.php">
                    <div class="order-inner">
                      <p class="order-id">
                        <?= $formattedId ?>
                      </p>
                      <p class="order-id">
                        <?= $row['Email'] ?>
                      </p>
                      <input type="hidden" name="reqid" value="<?= $row['Id'] ?>" />
                      <button type="submit" class="order-button">Сохранить</button>
                    </div>
                  </form>
                <?php
                }
                ?>
              </div>
            </div>

            <div class="tab-pane" data-tab-name="заказы">
              <div class="card-inner">

                <div class="catalog-mini" id="mini">
                  <div class="catalog-mini-content">
                    <div class="orders__wrapper">
                      <?php
                      foreach ($orders as $order) {
                      ?>
                        <div class="order">
                          <div class="order__info">
                            <div class="order__status-date">
                              <p class="order__status" style="color:<?= $order['status_color'] ?>; border: 1px solid <?= $order['status_color'] ?>"><?= $order['status_name'] ?> ●</p>
                              <p><?= $order['created_at'] ?></p>
                            </div>
                            <p class="cart-produt__total">
                              Сумма заказа:<br>
                              <span class="catalog-one-text price"><?= number_format($order['total'], 0, '.', ' ') ?> ₽</span>
                            </p>
                          </div>
                          <?php if (!empty($order['address'])) : ?>
                            <p class="order__location">
                              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 11.5A2.5 2.5 0 0 1 9.5 9A2.5 2.5 0 0 1 12 6.5A2.5 2.5 0 0 1 14.5 9a2.5 2.5 0 0 1-2.5 2.5M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7" />
                              </svg>
                              <?= $order['address'] ?>
                            </p>
                          <?php endif; ?>
                          <?php
                          $stmt = $mysql->prepare('SELECT product.*, COUNT(product.id) as product_count FROM order_products JOIN orders ON order_products.order_id = orders.id JOIN product ON order_products.product_id = product.id WHERE orders.id = ? AND status_id != 1 GROUP BY product.id');
                          $stmt->bind_param('i', $order['id']);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          if ($result) {
                            $order_products = $result->fetch_all(MYSQLI_ASSOC);
                          }
                          $stmt->close();
                          ?>
                          <div class="order__products">
                            <?php foreach ($order_products as $product) : ?>

                              <div class="cart-product">
                                <div class="cart-product__name-image">
                                  <div class="cart-product__image_container">
                                    <div class="cart-produt__quantity">
                                      <?= $product['product_count'] ?>
                                    </div>
                                    <a href="card.php?id=<?= $product['Id'] ?>">
                                      <img class="catalog-mini-img" src="/img/products/<?= $product['Photo'] ?>" alt="Product Photo">
                                    </a>
                                  </div>
                                  <div>
                                    <p class="cart-product__name"><?= $product['Name'] ?></p>
                                    <p class="cart-product__price"><?= number_format($product['Price'], 0, '.', ' ') ?> ₽</p>
                                  </div>
                                </div>
                                <p class="cart-produt__total">
                                  Итого:<br>
                                  <span class="cart-product__price"><?= number_format($product['Price'] * $product['product_count'], 0, '.', ' ') ?> ₽</span>
                                </p>
                              </div>
                            <?php endforeach; ?>
                          </div>
                          <form method="post" action="php/change_order_status.php" class="orders__change-status_form">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                            <select name="status_id" class="choose">
                              <option selected disabled>Статус</option>
                              <?php foreach ($order_statuses as $status) : ?>
                                <?php if ($status['id'] != 1) : ?>
                                  <option value="<?= $status['id'] ?>" <?= $order['status_id'] == $status['id'] ? 'selected' : '' ?> style="color:<?= $status['color'] ?>">
                                    <?= $status['name'] ?>
                                  </option>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </select>
                            <button type="submit" class="cart-order">Сменить статус</button>
                          </form>
                        </div>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PROFILE END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>