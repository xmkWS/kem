<?php
session_start();
require 'db.php';
$errors = [];
$old = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reg'])) {
  foreach ($_POST as $key => $value) {
    $old[$key] = $value;
  }
  $_SESSION['old'] = $old;
  $login = $_POST['login'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $reppassword = $_POST['reppassword'];

  if ($login == "") {
    $errors['login'] = 'Введите логин';
  }
  if ($email == "") {
    $errors['email'] = 'Введите почту';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Некорректная почта';
  }
  if ($password == "") {
    $errors['password'] = 'Введите пароль';
  } else if (strlen($password) < 6) {
    $errors['password'] = 'Минимальная длина пароля - 6 символов';
  }
  if ($reppassword == "") {
    $errors['reppassword'] = 'Введите пароль повторно';
  } else if (strlen($reppassword) < 6) {
    $errors['reppassword'] = 'Минимальная длина пароля - 6 символов';
  } else if ($password !== $reppassword) {
    $errors['password'] = 'Пароли не совпадают';
  }

  if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location: /sign-up.php");
  } else {
    $result = $mysql->query("SELECT * FROM `user` WHERE `Email` = '$email'");
    $user = $result->fetch_assoc();
    if (empty($user) || count($user) === 0) {
      $options = [
        'cost' => 12
      ];
      $pass = password_hash($password, PASSWORD_BCRYPT, $options);

      $stmt = $mysql->prepare("INSERT INTO `user`(`Login`, `Email`, `Password`, `IdRole`) VALUES(?, ?, ?, 1)");
      $stmt->bind_param('sss', $login, $email, $pass);
      if ($stmt->execute()) {
        setcookie("user", "success", time() + 3600, "/");
        $_SESSION['id'] = $mysql->insert_id;
        $result = $mysql->query("SELECT * FROM `user` WHERE `id` = '$mysql->insert_id'");
        $user = $result->fetch_assoc();
        $_SESSION['login'] = $user['Login'];
        $_SESSION['email'] = $user['Email'];
        $_SESSION['idrole'] = $user['IdRole'];

        session_regenerate_id();
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
        if ($user['IdRole'] == 2)
          header("Location: /admin.php?tab=заказы");
        else
          header("Location: /profile.php?tab=заказы");

        $stmt->close();
      } else header("Location: /sign-up.php");
    } else {
      $errors['email'] = 'Такой пользователь уже существует';
      $_SESSION['errors'] = $errors;
      header("Location: /sign-up.php");
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log'])) {
  foreach ($_POST as $key => $value) {
    $old[$key] = $value;
  }
  $_SESSION['old'] = $old;

  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($password == "") {
    $errors['password'] = 'Введите пароль';
  }
  if ($email == "") {
    $errors['email'] = 'Введите почту';
  }

  if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location: /sign-in.php");
  } else {
    $result = $mysql->query("SELECT * FROM `user` WHERE `Email` = '$email'");
    $user = $result->fetch_assoc();
    if (empty($user) || count($user) === 0) {
      $errors['email'] = "Такого пользователя не существует";
      $_SESSION['errors'] = $errors;
      header("Location: /sign-in.php");
    } else {
      if (!password_verify($password, $user['Password'])) {
        $errors['email'] = "Неверный пароль";
        $_SESSION['errors'] = $errors;
        header("Location: /sign-in.php");
      } else {
        setcookie("user", "success", time() + 3600, "/");
        $_SESSION['id'] = $user['Id'];
        $_SESSION['login'] = $user['Login'];
        $_SESSION['photo'] = $user['Photo'];
        $_SESSION['email'] = $user['Email'];
        $_SESSION['idrole'] = $user['IdRole'];

        session_regenerate_id();
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
        if ($user['IdRole'] == 2)
          header("Location: /admin.php?tab=заказы");
        else
          header("Location: /profile.php?tab=заказы");
      }
    }
  }
}
