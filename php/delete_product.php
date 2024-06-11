<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $prodid = isset($_POST['prodid']) ? $_POST['prodid'] : '';

  if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    // $stmt_cart = $mysql->prepare('DELETE FROM `orders` WHERE `IdProduct` = ? and ');
    // $stmt_cart->bind_param('i', $prodid);
    // $stmt_cart->execute();
    // $stmt_cart->close();

    $stmt = $mysql->prepare('DELETE FROM `product` WHERE `Id` = ?');
    $stmt->bind_param('i', $prodid);

    if ($stmt->execute()) {
      $_SESSION['alert'] = 'Товар удалён';
      header("Location: /catalog.php");
    } else {
      echo 'Ошибка при удалении данных: ' . $stmt->error;
    }

    $stmt->close();
    $mysql->close();
  }
}
