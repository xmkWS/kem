<?php
session_start();
require 'php/db.php';

if (isset($_SESSION['id']) && $_SESSION['idrole'] > 1) {
  $currentUserId = $_SESSION['id'];
  $currentUserLogin = $_SESSION['login'];
  $currentUserPhoto = $_SESSION['photo'];
  $currentUserEmail = $_SESSION['email'];
  $currentUserRole = $_SESSION['idrole'];

  if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT * FROM product WHERE Id = $productId";
    $result = $mysql->query($sql);

    if ($result) {
      $row = $result->fetch_assoc();
      if ($row) {
        $productName = $_SESSION['old']['name'] ? $_SESSION['old']['name'] : $row['Name'];
        $productPrice = $_SESSION['old']['price'] ? $_SESSION['old']['price'] : $row['Price'];
        $productDesc = $_SESSION['old']['description'] ? $_SESSION['old']['description'] : htmlspecialchars($row['Description']);
        $productType = $_SESSION['old']['product_type'] ? $_SESSION['old']['product_type'] : $row['IdProduct'];
        $productColor = $_SESSION['old']['product_color'] ? $_SESSION['old']['product_color'] : $row['color_id'];
        $productMaterial = $_SESSION['old']['product_material'] ? $_SESSION['old']['product_material'] : $row['material_id'];
        $productSize = $_SESSION['old']['product_size'] ? $_SESSION['old']['product_size'] : $row['size_id'];

        $stmt = $mysql->query("SELECT * FROM producttype");
        $productTypes = $stmt->fetch_all(MYSQLI_ASSOC);
        $stmt = $mysql->query("SELECT * FROM product_colors");
        $productColors = $stmt->fetch_all(MYSQLI_ASSOC);
        $stmt = $mysql->query("SELECT * FROM product_materials");
        $productMaterials = $stmt->fetch_all(MYSQLI_ASSOC);
        $stmt = $mysql->query("SELECT * FROM product_sizes");
        $productSizes = $stmt->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
      } else {
        die("Товар не найден");
      }
    } else {
      die("Ошибка SQL-запроса");
    }
  }
} else header("Location: /sign-in.php");
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
            Редактировать товар
          </h1>
          <form action="php/edit_product.php" method="post" enctype="multipart/form-data">
            <div class="sign-forms">
              <input type="hidden" name="id" value="<?= $productId ?>">
              <input class="sign-input" type="text" name="name" placeholder="Название*" value="<?= $productName ?>">
              <p class="err-text"><?= $_SESSION['errors']['name'] ?></p>
              <input class="sign-input" type="number" name="price" placeholder="Цена*" value="<?= $productPrice ?>">
              <p class="err-text"><?= $_SESSION['errors']['price'] ?></p>
              <textarea class="sign-input" name="description" placeholder="Описание*" id="description"><?= $productDesc ?></textarea>
              <p class="err-text"><?= $_SESSION['errors']['description'] ?></p>
              <input class="upload" type="file" name="photo">
              <p class="err-text"><?= $_SESSION['errors']['photo'] ?></p>
              <select class="choose" name="product_type">
                <option value="" selected disabled>Выберите категорию*</option>
                <?php foreach ($productTypes as $item) : ?>
                  <?php if ($item['Id'] == $productType) { ?>
                    <option value="<?= $item['Id'] ?>" selected><?= $item['Name'] ?></option>
                  <?php } else { ?>
                    <option value="<?= $item['Id'] ?>"><?= $item['Name'] ?></option>
                  <?php } ?>
                <?php endforeach; ?>
              </select>
              <p class="err-text"><?= $_SESSION['errors']['product_type'] ?></p>

              <select class="choose" name="product_color">
                <option value="" selected disabled>Цвет товара</option>
                <option value="">Не указывать</option>
                <?php foreach ($productColors as $item) : ?>
                  <?php if ($item['id'] == $productColor) { ?>
                    <option value="<?= $item['id'] ?>" selected><?= $item['name'] ?></option>
                  <?php } else { ?>
                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                  <?php } ?>
                <?php endforeach; ?>
              </select>
              <p class="err-text"><?= $_SESSION['errors']['product_color'] ?></p>
              <select class="choose" name="product_material">
                <option value="" selected disabled>Материал товара</option>
                <option value="">Не указывать</option>
                <?php foreach ($productMaterials as $item) : ?>
                  <?php if ($item['id'] == $productMaterial) { ?>
                    <option value="<?= $item['id'] ?>" selected><?= $item['name'] ?></option>
                  <?php } else { ?>
                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                  <?php } ?>
                <?php endforeach; ?>
              </select>
              <p class="err-text"><?= $_SESSION['errors']['product_material'] ?></p>
              <select class="choose" name="product_size">
                <option value="" selected disabled>Размер товара</option>
                <option value="">Не указывать</option>
                <?php foreach ($productSizes as $item) : ?>
                  <?php if ($item['id'] == $productSize) { ?>
                    <option value="<?= $item['id'] ?>" selected><?= $item['name'] ?></option>
                  <?php } else { ?>
                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                  <?php } ?>
                <?php endforeach; ?>
              </select>
              <p class="err-text"><?= $_SESSION['errors']['product_size'] ?></p>
              <?php unset($_SESSION['errors']) ?>
              <?php unset($_SESSION['old']) ?>
              <button type="submit" class="sign-button">Редактировать товар</button>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <!-- SIGN END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>