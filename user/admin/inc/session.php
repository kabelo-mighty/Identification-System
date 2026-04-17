<?php
include 'inc/connect.php';
require_once __DIR__ . '/../../../src/auth.php';

app_start_session();

if (empty($_SESSION['email']) || empty($_SESSION['admin_id'])) {
  $loginPath = basename(dirname($_SERVER['SCRIPT_NAME'])) === 'inc' ? '../index.php' : 'index.php';
  app_redirect($loginPath, 'Please login to continue.');
}

$email = $_SESSION['email'];
$id = $_SESSION['admin_id'];
?>