<?php
session_start();
if(! isset($_SESSION['user']['user_name'])){
  header('Location: ../sign_in/sign_in.php');
    die();
}


require_once(__DIR__.'../../globals.php');
require_once(__DIR__.'../../db.php');

$name = "A";
// $_to_email = "santiagokeatestemail@gmail.com";
$_to_email = $_SESSION['user']['email'];
$verification_key = $_SESSION['user']['verification_key'];
// $verification_key = "12345678901234567890123456789012";
$_message = "Thank you. 
  <a href='http://localhost/Amazon/email/validate-user.php?key=$verification_key'>
    Click here to verify your account
  </a>";

require_once(__DIR__."/private/send_email.php");