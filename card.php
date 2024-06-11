<?php
session_start();
require 'php/db.php';

if (isset($_SESSION['id'])) {
  $currentUserId = $_SESSION['id'];
  $currentUserLogin = $_SESSION['login'];
  $currentUserPhoto = $_SESSION['photo'];
  $currentUserEmail = $_SESSION['email'];
  $currentUserRole = $_SESSION['idrole'];
}

if (isset($_GET['id'])) {
  $productId = $_GET['id'];

  $sql = "SELECT p.*, pc.name as color_name, pm.name as material_name, ps.name as size_name
  FROM product p
  LEFT JOIN product_colors pc ON (p.color_id = pc.id)
  LEFT JOIN product_materials pm ON (p.material_id = pm.id)
  LEFT JOIN product_sizes ps ON (p.size_id = ps.id)
  WHERE p.id = {$productId} AND (p.color_id IS NOT NULL OR p.material_id IS NOT NULL OR p.size_id IS NOT NULL)";
  $result = $mysql->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();
    if (!$row) {
      $sql = "SELECT * FROM product WHERE id = {$productId}";
      $result = $mysql->query($sql);
      $row = $result->fetch_assoc();
      if (!$row) {
        die("Товар не найден");
      }
    }
    $stmt = $mysql->prepare('SELECT COUNT(*) from order_products JOIN orders on order_products.order_id = orders.id WHERE orders.user_id = ? AND  order_products.product_id = ? AND status_id = 1');
    $stmt->bind_param('ii', $currentUserId, $productId);
    $stmt->execute();
    $stmt->bind_result($cartCount);
    $stmt->fetch();
    $stmt->close();
    $stmt = $mysql->prepare("SELECT COUNT(id) FROM favorites WHERE `product_id` = ? AND `user_id` = ?");
    $stmt->bind_param('ii', $productId, $currentUserId);
    $stmt->bind_result($favoritesCount);
    $stmt->execute();
    $stmt->fetch();
    $productName = $row['Name'];
    $productPrice = $row['Price'];
    $productDesc = nl2br($row['Description']);
    $productColor = $row['color_name'];
    $productMaterial = $row['material_name'];
    $productSize = $row['size_name'];
    $productPhoto = $row['Photo'];
  } else {
    die("Ошибка SQL-запроса");
  }
}

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
  <script src="./js/burger.js" defer></script>
  <title>KEMII</title>
</head>

<body>

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>

  <!-- CATALOG START -->

  <div class="sign">
    <div class="container">
      <div class="sign-content">
        <div class="sign-text">
          <h1 class="catalog-title">
            <?= $productName ?>
          </h1>
        </div>
        <div class="catalog-card-one">
          <img class="catalog-one-img" src="./img/products/<?= $productPhoto ?>" alt="Product Photo">
          <div class="card-text-content">
            <!-- <p class="catalog-one-text name"><?= $productName ?></p> -->
            <p class="catalog-one-text price"><?= number_format($productPrice, 0, '.', ' ') ?> ₽</p>
            <div class="catalog-one-text description_container">
              <?php
              $lines = explode("<br />", $productDesc);

              $newText = '';

              foreach ($lines as $line) {
                $newText .= "<p class='catalog-one-text description'>$line</p>";
              }

              echo $newText;
              ?>
            </div>
            <?php if (!empty($productMaterial) || !empty($productColor) || !empty($productSize)) : ?>
              <div class="catalog-one-characteristics">
                <h3>Характеристики изделия:</h3>
                <?php if (!empty($productColor)) : ?>
                  <p>Цвет: <?= $productColor ?></p>
                <?php endif; ?>
                <?php if (!empty($productMaterial)) : ?>
                  <p>Материал: <?= $productMaterial ?></p>
                <?php endif; ?>
                <?php if (!empty($productSize)) : ?>
                  <p>Размер: <?= $productSize ?></p>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="card__buttons">
          <?php if ($currentUserRole == 1) : ?>
            <?php if (isset($cartCount) && $cartCount > 0) { ?>
              <div class="card__cart">
                <form method="post" action="php/add_to_card.php">
                  <input type="hidden" name="pid" value="<?= $productId ?>">
                  <button type="submit" class="cart__button">
                    +
                  </button>
                </form>
                <p><?= $cartCount ?></p>
                <form method="post" action="php/remove_from_card.php">
                  <input type="hidden" name="pid" value="<?= $productId ?>">
                  <button type="submit" class="cart__button">
                    -
                  </button>
                </form>
              </div>
            <?php } else { ?>
              <form method="post" action="php/add_to_card.php">
                <input type="hidden" name="pid" value="<?= $productId ?>">
                <button type="submit" class="catalog-button">
                  Добавить в корзину
                </button>
              </form>
            <?php } ?>
            <?php if (isset($favoritesCount) && $favoritesCount == 0) { ?>
              <form method="post" action="php/add_to_favorites.php">
                <input type="hidden" name="pid" value="<?= $productId ?>">
                <button type="submit" class="catalog-button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m12.1 18.55l-.1.1l-.11-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04 1 3.57 2.36h1.86C13.46 6 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05M16.5 3c-1.74 0-3.41.81-4.5 2.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5c0 3.77 3.4 6.86 8.55 11.53L12 21.35l1.45-1.32C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3" />
                  </svg>
                </button>
              </form>
            <?php } else { ?>
              <form method="post" action="php/remove_from_favorites.php">
                <input type="hidden" name="pid" value="<?= $productId ?>">
                <button type="submit" class="catalog-button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.27 2 8.5C2 5.41 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.41 22 8.5c0 3.77-3.4 6.86-8.55 11.53z" />
                  </svg>
                </button>
              </form>
            <?php } ?>
          <?php elseif ($currentUserRole == 2) : ?>
            <a class="catalog-button" href="edit.php?id=<?= $row['Id'] ?>">Редактировать</a>
            <a class="catalog-button" href="delete-accept.php?id=<?= $row['Id'] ?>">Удалить</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- CATALOG END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>