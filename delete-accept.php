<?php
session_start();

if (isset($_SESSION['id']) && $_SESSION['idrole'] > 1) {
  $currentUserId = $_SESSION['id'];
  $currentUserLogin = $_SESSION['login'];
  $currentUserPhoto = $_SESSION['photo'];
  $currentUserEmail = $_SESSION['email'];
  $currentUserRole = $_SESSION['idrole'];
} else header("Location: /sign-in.php");
if (isset($_GET['id'])) {
  $productId = $_GET['id'];
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

  <!-- SIGN START -->

  <div class="sign">
    <div class="container">
      <div class="sign-content">
        <div class="sign-text">
          <h1 class="accept-title">
            Вы действительно хотите удалить этот товар?
          </h1>
          <form method="post" action="php/delete_product.php">
            <input type="hidden" name="prodid" value="<?= $productId ?>">
            <button type="submit" class="accept-button" style="margin-left: auto; margin-right: auto;">Удалить</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- SIGN END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>