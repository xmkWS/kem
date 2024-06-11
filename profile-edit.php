<?php
session_start();
require 'php/db.php';

if (isset($_SESSION['id'])) {
  $currentUserId = $_SESSION['id'];
  $currentUserLogin = $_SESSION['login'];
  $currentUserPhoto = $_SESSION['photo'];
  $currentUserEmail = $_SESSION['email'];
  $currentUserRole = $_SESSION['idrole'];

  $result = $mysql->query("SELECT Photo FROM user WHERE Id = $currentUserId");
  $userData = $result->fetch_assoc();
  $userPhoto = $userData['Photo'];
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
          <form method="post" action="php/update_profile.php" enctype="multipart/form-data">
            <h1 class="sign-title">Редактирование профиля</h1>
            <div class="sign-forms">
              <div class="profile-pfp">
                <?php if ($_SESSION['photo']) { ?>
                  <img class="profile-pfp-inner" src="img/avatars/<?= $_SESSION['photo'] ?>" alt="User Photo">
                <?php } else { ?>
                  <img class="profile-pfp-inner" src="./img/main.png" alt="User Photo">
                <?php } ?>
              </div>
              <?php
              if ($_SESSION['old']['login']) $currentUserLogin = $_SESSION['old']['login'];
              ?>
              <input class="sign-input" type="text" name="login" placeholder="Логин" value="<?= $currentUserLogin ?>">
              <p class="err-text"><?= $_SESSION['errors']['login'] ?></p>
              <?php
              if ($_SESSION['old']['email']) $currentUserEmail = $_SESSION['old']['email'];
              ?>
              <input class="sign-input" type="text" name="email" placeholder="Почта" value="<?= $currentUserEmail ?>">
              <p class="err-text"><?= $_SESSION['errors']['email'] ?></p>
              <input class="sign-input" type="file" name="photo">
              <p class="err-text"><?= $_SESSION['errors']['photo'] ?></p>
              <?php unset($_SESSION['errors']) ?>
              <?php unset($_SESSION['old']) ?>
              <button type="submit" class="sign-button">Сохранить</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- SIGN END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>