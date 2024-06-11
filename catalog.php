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

  <!-- CATALOG START -->

  <div class="sign">
    <div class="container">
      <div class="sign-content">
        <div class="sign-text">
          <h1 class="catalog-title">
            Каталог
          </h1>
          <div class="line-title"></div>
        </div>
        <div class="catalog__container">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="catalog-forms">
            <div class="sign-forms">
              <input class="sign-input" type="text" name="search" placeholder="Поиск..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
              <select class="choose" name="product_type">
                <option value="">Все</option>
                <option value="Обувь" <?php if (isset($_GET['product_type']) && $_GET['product_type'] === 'Обувь') echo 'selected'; ?>>
                  Обувь</option>
                <option value="Куртка" <?php if (isset($_GET['product_type']) && $_GET['product_type'] === 'Куртка') echo 'selected'; ?>>
                  Куртка</option>
                <option value="Свитер" <?php if (isset($_GET['product_type']) && $_GET['product_type'] === 'Свитер') echo 'selected'; ?>>
                  Свитер</option>
                <option value="Рубашка" <?php if (isset($_GET['product_type']) && $_GET['product_type'] === 'Рубашка') echo 'selected'; ?>>
                  Рубашка</option>
                <option value="Сумка" <?php if (isset($_GET['product_type']) && $_GET['product_type'] === 'Сумка') echo 'selected'; ?>>
                  Сумка</option>
                <?php if (isset($_GET['product_type']) && $_GET['product_type'] === 'Все') echo 'selected'; ?>>
                Все</option>
              </select>
              <button type="submit" class="sign-button">Применить</button>
            </div>
          </form>
          <div class="catalog-cards">
            <div class="catalog-mini" id="mini">
              <div class="catalog-mini-content">
                <div class="catalog-mini-cards">
                  <?php
                  $search = isset($_GET['search']) ? $_GET['search'] : '';
                  $product_type = isset($_GET['product_type']) ? $_GET['product_type'] : '';

                  $sql = "SELECT p.* FROM product AS p
												LEFT JOIN producttype AS pt ON p.IdProduct = pt.Id
												WHERE 1"; // начальное условие всегда верно

                  if (!empty($search)) {
                    $sql .= " AND p.Name LIKE '%$search'";
                  }

                  if (!empty($product_type)) {
                    $sql .= " AND pt.Name = '$product_type'";
                  }

                  $result = $mysql->query($sql);

                  if (!$result) {
                    die("Ошибка выполнения SQL-запроса: " . $mysql->error);
                  }

                  $count = 0;
                  while ($row = $result->fetch_assoc()) {
                  ?>
                    <div class="catalog-mini-card-one">
                      <a href="card.php?id=<?= $row['Id'] ?>">
                        <img class="catalog-mini-img" src="./img/products/<?= $row['Photo'] ?>" alt="Product Photo">
                      </a>
                      <p class="catalog-mini-text"><?= $row['Name'] ?></p>
                      <p class="catalog-mini-text"><?= number_format($row['Price'], 0, '.', ' ') ?> ₽</p>
                    </div>
                  <?php
                  }
                  $mysql->close();
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if ($currentUserRole == 2) : ?>
        <div class="catalog-buttons">
          <a href="add.php" class="sign-button">Добавить</a>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- CATALOG END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>