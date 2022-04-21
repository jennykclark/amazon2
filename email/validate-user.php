<?php 
$_title = 'Verify User';
require_once(__DIR__.'../../components/header.php');
session_start();
if(! isset($_SESSION['user']['user_name'])){
  header('Location: ../sign_in/sign_in');
    die();
}


require_once(__DIR__.'../../globals.php');
$db = require_once(__DIR__.'../../db.php');
$verificationKey = $_SESSION['user']['verification_key'];

try{

// TODO: Verify the key (must be 32 characters)
if( ! isset($_GET['key']) ){
  ?>
      <body>
    <nav id="signInNav">
        <div id="logoblack">
        <a href="../home/home"><img src="../image/amazonBlack.png" id="signLogo"alt=""></a>           
        </div>
    </nav>
      <main>
        <section id="signUP">
            <section id="smallersignin">
                <div id="sign">
                    <h1 id="lightFont"><?php echo "mmm... suspicious (key is missing)"; ?></h1>
                    <button id="createButton" onclick="document.location='../home/home'">Home</button>
                </div>
            </section>
        </section>
    </main>
  
  <?php
  exit();
}
if(strlen($_GET['key']) != 32){
  ?>
    <body>
    <nav id="signInNav">
        <div id="logoblack">
        <a href="../home/home"><img src="../image/amazonBlack.png" id="signLogo"alt=""></a>           
        </div>
    </nav>
      <main>
        <section id="signUP">
            <section id="smallersignin">
                <div id="sign">
                    <h1 id="lightFont"><?php echo "mmm... suspicious (key is not 32 chars)"; ?></h1>
                    <button id="createButton" onclick="document.location='../home/home'">Home</button>
                </div>
            </section>
        </section>
    </main>
  
  <?php
  exit();
}

if( $_GET["key"] != $verificationKey ){
  ?>
  <body>
    <nav id="signInNav">
        <div id="logoblack">
        <a href="../home/home"><img src="../image/amazonBlack.png" id="signLogo"alt=""></a>           
        </div>
    </nav>
      <main>
        <section id="signUP">
            <section id="smallersignin">
                <div id="sign">
                    <h1 id="lightFont"><?php echo "mmm... suspicious (keys don't match)"; ?></h1>
                    <button id="createButton" onclick="document.location='../home/home'">Home</button>
                </div>
            </section>
        </section>
    </main>
  
  <?php
  exit();
}
$verified1 = 1;

$q = $db->prepare('UPDATE users SET verified = :verified WHERE verification_key = :verification_key');
$q->bindValue(':verified', $verified1);
$q->bindValue('verification_key', $verificationKey);
$q->execute();

// echo "CONGRATS... you are verified";
// header('Location: ../home/home');
// exit();
// TODO: Say Congrats to the user
}catch(PDOException $ex){
  http_response_code(500);
  // echo $ex;
  exit();
}


?>
<body>
    <nav id="signInNav">
        <div id="logoblack">
        <a href="../home/home"><img src="../image/amazonBlack.png" id="signLogo"alt=""></a>           
        </div>
    </nav>

    <main>
        <section id="signUP">
            <section id="smallersignin">
                <div id="sign">
                    <h1 id="lightFont"><?php echo "CONGRATS... you are verified"; ?></h1>
                    <button id="createButton" onclick="document.location='../home/home'">Home</button>
                </div>
            </section>
        </section>
    </main>