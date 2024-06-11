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

  $sql = "SELECT * FROM product WHERE Id = $productId";
  $result = $mysql->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();

    $stmt = $mysql->prepare('SELECT COUNT(id) FROM `orders` WHERE user_id = ? AND product_id = ? AND status_id = 1 limit 1');
    $stmt->bind_param('ii', $userId, $row['Id']);
    $stmt->execute();
    $stmt->bind_result($cartCount);
    $stmt->fetch();
    if ($row) {
      $productName = $row['Name'];
      $productPrice = $row['Price'];
      $productDesc = $row['Description'];
      $productPhoto = $row['Photo'];
    } else {
      die("Товар не найден");
    }
  } else {
    die("Ошибка SQL-запроса");
  }
}

$mysql->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
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

          <div class="catalog-card-one">
            <img class="catalog-mini-img" src="./img/products/<?= $productPhoto ?>" alt="Product Photo">
            <div class="card-text-content">
              <p class="catalog-mini-text"><?= $productName ?></p>
              <p class="catalog-mini-text"><?= number_format($productPrice, 0, '.', ' ') ?> ₽</p>
              <p class="catalog-mini-text"><?= $productDesc ?></p>
            </div>
          </div>
          <?php if ($currentUserRole == 1) : ?>
            <?php if (isset($cartCount) && $cartCount > 0) { ?>
              <div class="card__cart">
                <form method="post" action="php/add_to_card.php" style="display:flex; justify-content: center;">
                  <input type="hidden" name="pid" value="<?= $productId ?>">
                  <button type="submit" class="catalog-button">
                    +
                  </button>
                </form>
                <p><?= $cartCount ?></p>
                <form method="post" action="php/remove_from_card.php" style="display:flex; justify-content: center;">
                  <input type="hidden" name="pid" value="<?= $productId ?>">
                  <button type="submit" class="catalog-button">
                    -
                  </button>
                </form>
              </div>
            <?php } else { ?>
              <form method="post" action="php/add_to_card.php" style="display:flex; justify-content: center;">
                <input type="hidden" name="pid" value="<?= $productId ?>">
                <button type="submit" class="catalog-button">
                  Добавить в корзину
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

  <!-- CATALOG END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>