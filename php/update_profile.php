<?php
session_start();
require 'db.php';
$errors = [];
$old = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_SESSION['id'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    foreach ($_POST as $key => $value) {
      $old[$key] = $value;
    }
    $_SESSION['old'] = $old;

    if ($email == "") {
      $errors['email'] = 'Введите почту';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Некорректная почта';
    }
    if ($login == "") {
      $errors['login'] = 'Введите логин';
    }
    if (!empty($_FILES['photo']['tmp_name'])) {
      $file_name = $_FILES['photo']['name'];
      $file_size = $_FILES['photo']['size'];

      $allowed_extensions = array("jpg", "jpeg", "png", "webp");
      $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

      if (!in_array($file_extension, $allowed_extensions)) {
        $errors['photo'] = 'Неверный формат файла';
      }
      if ($file_size > 5000000) {
        $errors['photo'] = 'Максимальный размер файла - 5мб';
      }
    }
    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      header("Location: /profile-edit.php");
    } else {
      $userId = $_SESSION['id'];
      $stmt = $mysql->prepare('UPDATE user SET Login = ?, Email = ? WHERE id = ?');
      $stmt->bind_param('ssi', $login, $email, $userId);
      if ($stmt->execute()) {
        $_SESSION['login'] = $login;
        $_SESSION['email'] = $email;

        if (!empty($_FILES['photo']['tmp_name'])) {
          $random_filename = uniqid() . '.' . $file_extension;
          $uploadsFolder = $_SERVER['DOCUMENT_ROOT'] . '/img/avatars/';
          $upload_path = $uploadsFolder;

          $file_tmp = $_FILES['photo']['tmp_name'];
          if (!file_exists($upload_path)) {
            mkdir($upload_path);
            chmod($upload_path, 0777);
          }
          $upload_path .= $random_filename;
          $result = $mysql->query("SELECT * FROM `user` WHERE `Email` = '$email'");
          $user = $result->fetch_assoc();
          if ($user['Photo']) {
            $oldUpload = $uploadsFolder . $user['Photo'];
            if (file_exists($oldUpload)) {
              unlink($oldUpload);
            }
          }
          if (move_uploaded_file($file_tmp, $upload_path)) {
            $stmt = $mysql->prepare("UPDATE user SET Photo = ? WHERE id = ?");
            $stmt->bind_param("si", $random_filename, $userId);
            $stmt->execute();
            $stmt->close();
            $_SESSION['photo'] = $random_filename;
          }
        }
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
        $_SESSION['alert'] = 'Профиль изменён';
        if ($_SESSION['idrole'] > 1)
          header("Location:/admin.php");
        else
          header("Location:/profile.php");
      }
    }
  } else header("Location: /sign-in.php");
}
