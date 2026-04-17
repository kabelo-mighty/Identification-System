<?php
include __DIR__ . '/connect.php';
require_once __DIR__ . '/../../../src/auth.php';

app_start_session();

if (empty($_SESSION['email']) || empty($_SESSION['person_id'])) {
  $loginPath = basename(dirname($_SERVER['SCRIPT_NAME'])) === 'inc' ? '../../login.php' : 'login.php';
  app_redirect($loginPath, 'Please login to continue.');
}

$email = $_SESSION['email'];
$id = $_SESSION['person_id'];
?>