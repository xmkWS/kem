<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $reqid = isset($_POST['reqid']) ? $_POST['reqid'] : '';

  if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    $isAccepted = 1;
    $stmt = $mysql->prepare('UPDATE `request` SET isAccepted = ? WHERE Id = ?');
    $stmt->bind_param('ii', $isAccepted, $reqid);

    if ($stmt->execute()) {
      header("Location:". $_SERVER['HTTP_REFERER']);
    }

    $stmt->close();
    $mysql->close();
  }
}
