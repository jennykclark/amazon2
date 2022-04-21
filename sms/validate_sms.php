<?php 
$_title = 'Verify User with sms';
require_once(__DIR__.'../../components/header.php');
session_start();
if(! isset($_SESSION['user']['user_name'])){
    header('Location: ../sign_in/sign_in');
    die();
}
if (!isset($_SESSION["lang"])) { $_SESSION["lang"] = "en"; }
if (isset($_POST["lang"])) { $_SESSION["lang"] = $_POST["lang"]; }

require "../lan/lang." . $_SESSION["lang"] . ".php";

require_once(__DIR__.'../../globals.php');
require_once(__DIR__.'../../db.php');

try{
    $db = _db();
}catch(Exception $ex){
    _res(500, ['info'=>'System under maintainance','error'=>__LINE__]);
}

try{
    $base = $db->prepare('SELECT * FROM users WHERE user_id = :userID');
$base->bindValue(":userID", $_SESSION['user']['user_id']);

$base->execute();
}catch(PDOException $e) {
    exit();
}

$user=$base->fetch();

?>
<body id="itemsBody">
<nav id="amazonNav">
<div id="logo">
        <a href="../home/home"><img src="../image/amazonLogo.png" id="amazonLogo"></a>
        </div>
        <div id="Delivery">
            <i class="fas fa-map-marker-alt"></i> 
            <p><!--<span id="deliveryGrey"></span> <br>--><?=$_TXT[0]?></p>
        </div>
        <div id="search">
            <div id="dropdown"><p><?=$_TXT[1]?></p></div>
            <input id="searchbar" onkeyup="search_animal()" type="text" name="search"> <button id="searchButton"><i class="fas fa-search"></i></button>
        </div>
        <div id="tools">
        <div id="flag">
            <img src="../image/denmark.png" id="denmarkFlag">
        </div>
        <div id="account" class="dropdown">
           
        <button class="dropbtn"><p> 
                <span><?=$_TXT[2]?></span>
               <?php echo $user['user_name'] ?>7
           </p>
        </button> 
        <div class="dropdown-content">
            <h4><?=$_TXT[3]?></h4>
            <a href="../account/account"><?=$_TXT[4]?></a>
            <a href="../add_items/upload_item"><?=$_TXT[5]?></a>
            <a href="../update_items/update_item"><?=$_TXT[6]?></a>
            <a href="../sign_in/sign_in"><?=$_TXT[7]?></a>
            <a href="../logout/logout"><?=$_TXT[8]?></a>
            </div>

        </div>
        <div id="Order">
            <!-- <p> Return </p>
             <p>&amp;Orders</p> -->
             <p>
                 <span><?=$_TXT[9]?></span>
             </p>
        </div>
        <div id="basket">
            <!-- <p>Basket</p> -->
            <i class="fas fa-shopping-cart"></i>
        </div>
        </div>
        </div>
    </nav>
<div id="secondnav">
    <div id="all">
        <p> &#9776; <?=$_TXT[10]?></p>
    </div>
    <div id="deals">
        <p><?=$_TXT[11]?></p>
    </div>
    <div id="grocery">
        <p><?=$_TXT[12]?></p>
    </div>
    <div id="free">
        <p><?=$_TXT[13]?></p>
    </div>
    <div id="buy">
        <p><?=$_TXT[14]?></p>
    </div>
    <div id="language">
        <form id="from_lan" method="post">
    <input class="button_lan" type="submit" name="lang" value="en"/>
    <input class="button_lan" type="submit" name="lang" value="ga"/>
  </form>
    </div>
</div>

    
<section id="UploadDIv">
    <h1><?=$_TXT[80]?></h1>

<form class="style_form" id="sms_up" onsubmit="return validate_sms_form(); false">
<div>
  <label for="phone_number"><?=$_TXT[80]?></label>
  <input name="phone_number" id="phoneNumber" type="number" placeholder="<?=$_TXT[80]?>" value="<?php echo $user['phone_number']?>" require>
</div>
<div>
  <input name="user_id" type="hidden" value="<?php echo $_SESSION['user']['user_id']?>"require>
</div>
  <button onclick="send_sms()" id="updateButton"><?=$_TXT[82]?></button>  
    
</form>
</section>



<?php
require_once(__DIR__.'../../components/footer.php');
?>