<?php
session_start();
require 'php/db.php';

if (isset($_SESSION['id']) && $_SESSION['idrole'] > 1) {
  $currentUserId = $_SESSION['id'];
  $currentUserLogin = $_SESSION['login'];
  $currentUserPhoto = $_SESSION['photo'];
  $currentUserEmail = $_SESSION['email'];
  $currentUserRole = $_SESSION['idrole'];

  $stmt = $mysql->query("SELECT * FROM producttype");
  $productTypes = $stmt->fetch_all(MYSQLI_ASSOC);
  $stmt->close();
  $stmt = $mysql->query("SELECT * FROM product_colors");
  $productColors = $stmt->fetch_all(MYSQLI_ASSOC);
  $stmt->close();
  $stmt = $mysql->query("SELECT * FROM product_materials");
  $productMaterials = $stmt->fetch_all(MYSQLI_ASSOC);
  $stmt->close();
  $stmt = $mysql->query("SELECT * FROM product_sizes");
  $productSizes = $stmt->fetch_all(MYSQLI_ASSOC);
  $stmt->close();
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
            Добавить товар
          </h1>
          <div class="sign-forms">
            <form action="php/add_product.php" method="post" enctype="multipart/form-data">
              <div class="sign-forms">
                <input class="sign-input" type="text" name="name" placeholder="Название*" value="<?= $_SESSION['old']['name'] ?>">
                <p class="err-text"><?= $_SESSION['errors']['name'] ?></p>
                <input class="sign-input" type="number" name="price" placeholder="Цена*" value="<?= $_SESSION['old']['price'] ?>">
                <p class="err-text"><?= $_SESSION['errors']['price'] ?></p>
                <textarea class="sign-input" type="text" name="description" placeholder="Описание*"><?= $_SESSION['old']['description'] ?></textarea>
                <p class="err-text"><?= $_SESSION['errors']['description'] ?></p>
                <input class="upload" type="file" name="photo">
                <p class="err-text"><?= $_SESSION['errors']['photo'] ?></p>
                <select class="choose" name="product_type">
                  <option value="" selected disabled>Выберите категорию*</option>
                  <?php foreach ($productTypes as $productType) : ?>
                    <?php if ($productType['Id'] == $_SESSION['old']['product_type']) { ?>
                      <option value="<?= $productType['Id'] ?>" selected><?= $productType['Name'] ?></option>
                    <?php } else { ?>
                      <option value="<?= $productType['Id'] ?>"><?= $productType['Name'] ?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                <p class="err-text"><?= $_SESSION['errors']['product_type'] ?></p>
                <select class="choose" name="product_color">
                  <option value="" selected disabled>Цвет товара</option>
                  <option value="">Не указывать</option>
                  <?php foreach ($productColors as $productColor) : ?>
                    <?php if ($productColor['id'] == $_SESSION['old']['product_color']) { ?>
                      <option value="<?= $productColor['id'] ?>" selected><?= $productColor['name'] ?></option>
                    <?php } else { ?>
                      <option value="<?= $productColor['id'] ?>"><?= $productColor['name'] ?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                <p class="err-text"><?= $_SESSION['errors']['product_color'] ?></p>
                <select class="choose" name="product_material">
                  <option value="" selected disabled>Материал товара</option>
                  <option value="">Не указывать</option>
                  <?php foreach ($productMaterials as $productMaterial) : ?>
                    <?php if ($productMaterial['id'] == $_SESSION['old']['product_material']) { ?>
                      <option value="<?= $productMaterial['id'] ?>" selected><?= $productMaterial['name'] ?></option>
                    <?php } else { ?>
                      <option value="<?= $productMaterial['id'] ?>"><?= $productMaterial['name'] ?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                <p class="err-text"><?= $_SESSION['errors']['product_material'] ?></p>
                <select class="choose" name="product_size">
                  <option value="" selected disabled>Размер товара</option>
                  <option value="">Не указывать</option>
                  <?php foreach ($productSizes as $productSize) : ?>
                    <?php if ($productSize['id'] == $_SESSION['old']['product_size']) { ?>
                      <option value="<?= $productSize['id'] ?>" selected><?= $productSize['name'] ?></option>
                    <?php } else { ?>
                      <option value="<?= $productSize['id'] ?>"><?= $productSize['name'] ?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                <p class="err-text"><?= $_SESSION['errors']['product_size'] ?></p>
              </div>
              <?php unset($_SESSION['errors']) ?>
              <?php unset($_SESSION['old']) ?>
              <button type="submit" class="sign-button">Добавить товар</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SIGN END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>