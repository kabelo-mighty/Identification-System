<?php
include 'inc/connect.php';
require_once __DIR__ . '/../../../src/auth.php';

app_start_session();

if (empty($_SESSION['email']) || empty($_SESSION['person_id']) || empty($_SESSION['id_number'])) {
  $loginPath = basename(dirname($_SERVER['SCRIPT_NAME'])) === 'inc' ? '../../../account/login.php' : '../../account/login.php';
  app_redirect($loginPath, 'Please login to continue.');
}

$email = $_SESSION['email'];
$id = $_SESSION['person_id'];
$idno = $_SESSION['id_number'];
?>