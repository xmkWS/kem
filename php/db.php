<?php
try {
  $mysql = new mysqli('localhost', 'z576', 'dhhwJcJmsMrY2WHe', 'z576');
} catch (Exception $e) {
  try {
    $mysql = new mysqli('localhost', 'root', 'root', 'kemii');
  } catch (Exception $e) {
    $mysql = new mysqli('localhost', 'root', '', 'kemii');
  }
}
