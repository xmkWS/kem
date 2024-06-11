<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
  $statusId = $_POST['status_id'];
  $orderId = $_POST['order_id'];
  $stmt = $mysql->prepare("UPDATE orders SET status_id = ? WHERE id = ?");
  $stmt->bind_param('ii', $statusId, $orderId);
  $stmt->execute();
  $stmt->close();
  $_SESSION['alert'] = 'Статус заказа изменён';
} 
header("Location:".$_SERVER['HTTP_REFERER']);
