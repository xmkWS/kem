<?php
require 'php/logreg.php';

if (isset($_SESSION['id'])) {
  header('Location:/index.php');
  exit;
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
          <h1 class="sign-title">
            Регистрация
          </h1>
          <form method="post" action="php/logreg.php" enctype="multipart/form-data">
            <div class="sign-forms" style="flex-direction: column; align-items: center">
              <input class="sign-input" type="text" placeholder="Введите логин" name="login" value="<?= $_SESSION['old']['login'] ?>">
              <p class="err-text"><?= $_SESSION['errors']['login'] ?></p>
              <input class="sign-input" type="email" placeholder="Введите почту" name="email" value="<?= $_SESSION['old']['email'] ?>">
              <p class="err-text"><?= $_SESSION['errors']['email'] ?></p>
              <input class="sign-input" type="password" placeholder="Введите пароль" name="password">
              <p class="err-text"><?= $_SESSION['errors']['password'] ?></p>
              <input class="sign-input" type="password" placeholder="Повторите пароль" name="reppassword">
              <p class="err-text"><?= $_SESSION['errors']['reppassword'] ?></p>
              <!-- <input class="sign-input" type="file" name="photo" accept="image/*">
              <p class="err-text"><?= $_SESSION['errors']['photo'] ?></p> -->
              <?php unset($_SESSION['errors']) ?>
              <?php unset($_SESSION['old']) ?>
              <button type="submit" name="reg" class="sign-button">
                Регистрация
              </button>
            </div>
          </form>

          <p class="sign-info">
            Уже есть аккаунт? <br>
            <span><a href="sign-in.php">Авторизация</a></span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- SIGN END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>