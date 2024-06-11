<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
  $pid = isset($_POST['pid']) ? $_POST['pid'] : '';
  $userId = $_SESSION['id'];

  $stmt = $mysql->prepare("SELECT COUNT(id) FROM favorites WHERE `product_id` = ? AND `user_id` = ?");
  $stmt->bind_param('ii', $pid, $userId);
  $stmt->bind_result($favoritesCount);
  $stmt->execute();
  $stmt->fetch();
  $stmt->close();
  if (isset($favoritesCount) && $favoritesCount > 0) {
    $stmt = $mysql->prepare("DELETE FROM favorites WHERE product_id = ? AND user_id = ?");
    $stmt->bind_param('ii', $pid, $userId);
    $stmt->execute();
    $stmt->close();
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);
} else header('Location:/log.php');
