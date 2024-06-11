<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
  $pid = isset($_POST['pid']) ? $_POST['pid'] : '';
  $userId = $_SESSION['id'];

  $stmt = $mysql->prepare('SELECT id FROM `orders` WHERE user_id = ? AND status_id = 1 limit 1');
  $stmt->bind_param('i', $userId);
  $stmt->execute();
  $stmt->bind_result($cartId);
  $stmt->fetch();
  $stmt->close();
  if (!isset($cartId)) {
    $stmt = $mysql->prepare('INSERT INTO `orders`(`user_id`, `status_id`, `created_at`, `total`) VALUES (?,1,NOW(),0)');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $cartId = $stmt->insert_id;
    $stmt->close();
  }
  $stmt = $mysql->prepare('INSERT INTO `order_products`(`product_id`, `order_id`) VALUES (?,?)');
  $stmt->bind_param('ii', $pid, $cartId);
  $stmt->execute();
  $stmt->close();
  header('Location: ' . $_SERVER['HTTP_REFERER']);

} else header('Location:/log.php');
