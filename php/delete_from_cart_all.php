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

  $stmt = $mysql->prepare('DELETE FROM `order_products` WHERE order_id = ?');
  $stmt->bind_param('i', $cartId);
  $stmt->execute();
  $stmt->close();
  header('Location: ' . $_SERVER['HTTP_REFERER']);
} else header('Location:/log.php');
