<?php
session_start();
require 'db.php';
$old = array();
$errors = array();

if (!isset($_SESSION['id']) && $_SESSION['idrole'] != 2) header("Location: /sign-in.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $desc = $_POST['description'];
  $price = $_POST['price'];
  $product_type = $_POST['product_type'];
  $product_color = $_POST['product_color'];
  $product_material = $_POST['product_material'];
  $product_size = $_POST['product_size'];

  foreach ($_POST as $key => $value) {
    $old[$key] = $value;
  }
  $_SESSION['old'] = $old;

  if ($name == "") {
    $errors['name'] = 'Введите название';
  }
  if ($desc == "") {
    $errors['description'] = 'Введите описание';
  }
  if ($price == "") {
    $errors['price'] = 'Введите цену';
  }
  if ($product_type == "") {
    $errors['product_type'] = 'Введите тип продукта';
  }
  if ($_FILES['photo']) {
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
  } else {
    $errors['photo'] = 'Загрузите фото';
  }
  if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location: /add.php");
  } else {
    $random_filename = uniqid() . '.' . $file_extension;
    $uploadFolder = $_SERVER['DOCUMENT_ROOT'] . '/img/products/';
    $upload_path = $uploadFolder;

    $file_tmp = $_FILES['photo']['tmp_name'];
    if (!file_exists($upload_path)) {
      mkdir($upload_path);
      chmod($upload_path, 0777);
    }
    $upload_path .= $random_filename;
    if (move_uploaded_file($file_tmp, $upload_path)) {
      $sql = "INSERT INTO `product`(`Name`, `Photo`, `Price`, `Description`, `IdProduct`";
      $params = "sssss";
      $values = [$name, $random_filename, $price, $desc, $product_type];

      if (!empty($product_material)) {
        $sql .= ", `material_id`";
        $params .= "i";
        $values[] = $product_material;
      }

      if (!empty($product_color)) {
        $sql .= ", `color_id`";
        $params .= "i";
        $values[] = $product_color;
      }

      if (!empty($product_size)) {
        $sql .= ", `size_id`";
        $params .= "i";
        $values[] = $product_size;
      }

      $sql .= ") VALUES(" . str_repeat("?,", count($values) - 1) . "?)";

      $stmt = $mysql->prepare($sql);
      $stmt->bind_param($params, ...$values);
      $stmt->execute();
      $id = mysqli_insert_id($mysql);
      $stmt->close();
      unset($_SESSION['errors']);
      unset($_SESSION['old']);
      $_SESSION['alert'] = 'Товар добавлен';
      header("Location: /card.php?id=" . $id);
    }
  }
} else {
  header("Location: /catalog.php");
}
