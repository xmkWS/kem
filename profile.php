<?php
session_start();
require 'php/db.php';

if (isset($_SESSION['id'])) {
  if ($_SESSION['idrole'] > 1) {
    header('Location:/index.php');
    exit();
  }

  $currentUserId = $_SESSION['id'];
  $currentUserLogin = $_SESSION['login'];
  $currentUserPhoto = $_SESSION['photo'];
  $currentUserEmail = $_SESSION['email'];
  $currentUserRole = $_SESSION['idrole'];

  $result = $mysql->query("SELECT Photo FROM user WHERE Id = $currentUserId");
  $userData = $result->fetch_assoc();
  $userPhoto = $userData['Photo'];

  $stmt = $mysql->prepare('SELECT product.*, COUNT(product.id) as product_count FROM order_products JOIN orders ON order_products.order_id = orders.id JOIN product ON order_products.product_id = product.Id WHERE orders.user_id = ? AND status_id = 1 GROUP BY product.Id');
  $stmt->bind_param('i', $currentUserId);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result) {
    $products = $result->fetch_all(MYSQLI_ASSOC);
  }
  $stmt = $mysql->prepare('SELECT orders.*, order_statuses.name AS status_name, order_statuses.color as status_color FROM `orders` JOIN order_statuses on orders.status_id = order_statuses.id WHERE user_id = ? AND status_id != 1 ORDER BY orders.id DESC');
  $stmt->bind_param('i', $currentUserId);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result) {
    $orders = $result->fetch_all(MYSQLI_ASSOC);
  }
  $stmt->close();
} else header("Location:/sign-in.php");
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
  <script src="./js/modal.js" defer></script>

  <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=443555a1-116a-4142-80b6-aa1b23027614&suggest_apikey=f50b7ddd-d1a0-4810-b69d-c09d0139cc0d" type="text/javascript"></script>
  <script src="./js/suggest.js" type="text/javascript"></script>
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
            Личный кабинет
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
            <button type="button" class="tab-btn tab-btn-active" data-tab-name="корзина">Корзина</button>
            <button type="button" class="tab-btn" data-tab-name="заказы">Заказы</button>
          </div>
          <div class="tab-content">

            <div class="tab-pane tab-pane-show" data-tab-name="корзина">
              <?php if (isset($products) && count($products) > 0) { ?>
                <form method="post" action="php/delete_from_cart_all.php">
                  <input type="hidden" name="pid" value="<?= $row['Id'] ?>">
                  <button type="submit" class="catalog-button">
                    Удалить все товары из корзины
                  </button>
                </form>
                <div class="card-inner">
                  <div class="catalog-mini" id="mini">
                    <div class="catalog-mini-content-profile">
                      <div class="catalog-mini-cards-profile">
                        <?php
                        $sum = 0;
                        $products_count = 0;
                        foreach ($products as $row) :
                          $sum += ($row['Price'] * $row['product_count']);
                          $products_count += $row['product_count'];
                        ?>
                          <div class="cart-product">
                            <div class="cart-product__name-image">
                              <a href="card.php?id=<?= $row['Id'] ?>">
                                <img class="catalog-mini-img" src="/img/products/<?= $row['Photo'] ?>" alt="Product Photo">
                              </a>
                              <div>
                                <p class="cart-product__name"><?= $row['Name'] ?></p>
                                <p class="cart-product__price"><?= number_format($row['Price'], 0, '.', ' ') ?> ₽</p>
                              </div>
                            </div>
                            <p class="cart-produt__total">
                              Итоговая цена:<br>
                              <span class="cart-product__price"><?= number_format($row['Price'] * $row['product_count'], 0, '.', ' ') ?> ₽</span>
                            </p>
                            <div class="card__buttons">
                              <div class="card__cart">
                                <form method="post" action="php/add_to_card.php">
                                  <input type="hidden" name="pid" value="<?= $row['Id'] ?>">
                                  <button type="submit" class="cart__button">
                                    +
                                  </button>
                                </form>
                                <p><?= $row['product_count'] ?></p>
                                <form method="post" action="php/remove_from_card.php">
                                  <input type="hidden" name="pid" value="<?= $row['Id'] ?>">
                                  <button type="submit" class="cart__button">
                                    -
                                  </button>
                                </form>
                              </div>
                              <form method="post" action="php/delete_from_cart.php">
                                <input type="hidden" name="pid" value="<?= $row['Id'] ?>">
                                <button type="submit" class="cart__button">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                  </svg>
                                </button>
                              </form>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      </div>
                      <div class="cart-text">
                        <?php
                        if ($sum !== 0) {
                        ?>
                          <p class="cart-price">
                            Товаров: <?= $products_count ?>
                          </p>
                          <p class="cart-price">
                            Итого: <?= number_format($sum, 0, '.', ' ') ?> ₽
                          </p>
                          <div class="modal_parent">
                            <div class="modal">
                              <div class="modal-content">
                                <span class="close">&times;</span>
                                <h3 class="ordering__title">Оформление заказа</h3>
                                <form class="ordering__form" method="post" action="php/place_an_order.php" id="orderForm">
                                  <div class="card">
                                    <img src="./img/payments/logo-white.png" class="logo-card">
                                    <label>Номер карты</label>
                                    <input id="user" type="text" class="input cardnumber" name="cart_number" required placeholder="16 цифр" />
                                    <label>Фамилия Имя владельца карты:</label>
                                    <input class="input name" required placeholder="Фамилия Имя" name="cardholder" />
                                    <label class="toleft">CCV код:</label>
                                    <input class="input toleft ccv" placeholder="CVV" name="cvv" required />
                                  </div>
                                  <input class="sign-input" name="address" type="text" id="suggest1" placeholder="Адрес" required />
                                  <p class="err-text"><?= $_SESSION['errors']['address'] ?></p>
                                  <button type="button" id="orderBtn" class="cart-order ordering__btn">Оформить заказ</button>
                                  <button type="submit" id="orderBtnSubmit" style="display: none;">Sumittion btn</button>
                                  <?php unset($_SESSION['errors']) ?>
                                  <?php unset($_SESSION['old']) ?>
                                </form>
                              </div>
                            </div>
                            <button type="button" class="modal_open_button cart-order">Оформить заказ</button>
                          </div>
                      </div>
                    <?php
                        }
                    ?>
                    </div>
                  </div>
                <?php } else { ?>
                  <h2 class="cart__no-products">Вы ничего не добавили в корзину. <a href="/catalog.php">Перейти в каталог</a></h2>
                <?php } ?>
                </div>
            </div>
          </div>
        </div>

        <div class="tab-pane" data-tab-name="заказы">
          <div class="card-inner">
            <div class="catalog-mini" id="mini">
              <div class="catalog-mini-content-profile">
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