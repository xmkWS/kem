<?php
session_start();
require 'db.php';
$old = array();
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
  foreach ($_POST as $key => $value) {
    $old[$key] = $value;
  }
  $_SESSION['old'] = $old;

  if ($_POST['address'] == "") {
    $errors['address'] = 'Введите адрес';
  }
  if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location: /profile.php");
  } else {
    $userId = $_SESSION['id'];
    $stmt = $mysql->prepare("UPDATE orders o
  SET o.status_id = 3,
      o.created_at = NOW(),
      o.address = ?,
      o.total = (
          SELECT SUM(product.Price)
          FROM order_products op join product on op.product_id = product.id
          WHERE op.order_id = o.id
      )
  WHERE o.user_id = ? AND o.status_id = 1");
    $stmt->bind_param('si', $_POST['address'], $userId);
    $stmt->execute();
    $stmt->close();
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
    $_SESSION['alert'] = 'Заказ оформлен';
    header("Location: /profile.php");
  }
} else header("Location: /log.php");
