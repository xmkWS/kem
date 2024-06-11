<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = isset($_POST['email']) ? $_POST['email'] : '';

  if ($email != '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $isAccepted = 0;
    $stmt = $mysql->prepare("INSERT INTO `request`(`Email`, `isAccepted`) VALUES(?, ?)");
    $stmt->bind_param('si', $email, $isAccepted);
    if ($stmt->execute()) {
      $_SESSION['alert'] = 'Вы подписались на рассылку';
    }
  }
  header("Location: /index.php");
  exit;

  $stmt->close();
}
