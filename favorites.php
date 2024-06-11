<?php
session_start();
require 'php/db.php'; // Подключение файла с базой данных, если необходимо

if (isset($_SESSION['id'])) {
  $currentUserId = $_SESSION['id'];
  $currentUserLogin = $_SESSION['login'];
  $currentUserPhoto = $_SESSION['photo'];
  $currentUserEmail = $_SESSION['email'];
  $currentUserRole = $_SESSION['idrole'];
} else header("Location: /sign-in.php");

$stmt = $mysql->prepare("SELECT product.* FROM favorites JOIN product ON favorites.product_id = product.id WHERE favorites.user_id = ?");
$stmt->bind_param('i', $currentUserId);
$stmt->execute();
$result = $stmt->get_result();
$products = [];
while ($row = $result->fetch_assoc()) {
  $products[] = $row;
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
  <script src="./js/burger.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <title>KEMII</title>
</head>

<body>

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>

  <!-- CATALOG-MINI START -->

  <div class="container">
    <a href="#mini" class="presentation-title">
      Ваше избранное
    </a>
    <div class="catalog-mini" id="mini">
      <div class="catalog-mini-content">
        <div class="catalog-mini-cards">
          <?php foreach ($products as $product) : ?>
            <div class="catalog-mini-card-one">
              <a href="/card.php?id=<?= $product['Id'] ?>">
                <img class="catalog-mini-img" src="./img/products/<?= $product['Photo'] ?>" alt="<?= $product['Name'] ?>">
              </a>
              <p class="catalog-mini-text"><?= number_format($product['Price'], 0, '.', ' ') ?> ₽</p>
              <form method="post" action="php/remove_from_favorites.php">
                <input type="hidden" name="pid" value="<?= $product['Id'] ?>">
                <button type="submit" class="catalog-button">
                  Убрать из избранного
                </button>
              </form>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>


  <!-- CATALOG-MINI END -->
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>

</body>