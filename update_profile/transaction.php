<?php
$_title = 'Update profile';
require_once(__DIR__.'../../components/header.php');
session_start();
if(! isset($_SESSION['user_name'])){
    header('Location: ../sign_in/sign_in.php');
    die();
}
if (!isset($_SESSION["lang"])) { $_SESSION["lang"] = "en"; }
if (isset($_POST["lang"])) { $_SESSION["lang"] = $_POST["lang"]; }


require_once(__DIR__.'../../globals.php');
require_once(__DIR__.'../../db.php');

try{
    $db = _db();
}catch(Exception $ex){
    _res(500, ['info'=>'System under maintainance','error'=>__LINE__]);
}

// $userProduct = $_SESSION['user']['user_id'];

// $q = $db->prepare('SELECT * FROM users WHERE user_id = :userID');
// $q->bindValue(":userID", $userProduct);

// $q->execute();
require "../lan/lang." . $_SESSION["lang"] . ".php";

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
        <a href="../home/home.php"><img src="../image/amazonLogo.png" id="amazonLogo"></a>
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
               <?php echo $user['user_name'] ?>
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
             <p><?=$_TXT[8]?>
                 <span>&amp;<?=$_TXT[9]?></span>
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
    <h1><?=$_TXT[62]?></h1>

    <?php 
    $rows=$base->fetch()
    ?>
<form class="style_form" id="update_profile" onsubmit="return transaction_form(); false">

<div>
        <label for="name"><?=$_TXT[63]?></label>
        <input type="text" id="nameID" name="name" value="<?php echo $user['user_name']?>">
    </div>
    <div>
        <label for="last_name"><?=$_TXT[64]?></label>
        <input type="text" id="lastNameID" name="last_name" value="<?php echo $user['lastName']?>">
    </div>
    <div>
    <label for="email"><?=$_TXT[65]?></label>
      <input name="email" id="emailID" value="<?php echo $user['email']?>" type="text">
</div>
<!-- <div>
  <label for="phone_number"><?=$_TXT[80]?></label>
  <input name="phone_number" id="phoneID" type="text" placeholder="<?=$_TXT[80]?>" value="<?php echo $user['phone_number']?>" require>
</div> -->
<br>
<input type="hidden" name="userId" value="<?php echo $user['user_id'] ?>">

  <button onclick="update()" id="updateButton"><?=$_TXT[60]?></button>  

    
</form>
</section>


<?php
require_once(__DIR__.'../../components/footer.php');
?>
