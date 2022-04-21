<?php
$_title = 'Update Items';
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
try{
    $itemProduct =  $_GET['item_id'];
    $w = $db->prepare('SELECT * FROM items2 WHERE item_id = :Itemid');
    $w->bindValue(":Itemid", $itemProduct);
    $w->execute();
}catch(Exception $ex){
    _res(500, ['info'=>'System under maintainance','error'=>__LINE__]);
}

require "../lan/lang." . $_SESSION["lang"] . ".php";

try{
    $base = $db->prepare('SELECT * FROM users WHERE user_id = :userID');
$base->bindValue(":userID", $_SESSION['user']['user_id']);

$base->execute();
}catch(PDOException $e) {
    _res(500, ['info'=>'System under maintainance','error'=>__LINE__]);
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
    <h1><?=$_TXT[59]?></h1>
    <?php
    while($row2=$w->fetch())
{   
    ?>
<form class="style_form" id="update_item" onsubmit="return update_item_form(); false" enctype="multipart/form-data">

<div>
  <label for="ItemName"><?=$_TXT[53]?></label>
  <input name="item_name" id="item_name_id" type="text" placeholder="<?=$_TXT[53]?>" value="<?php echo $row2['item_name']?>" require> 
</div>
<div>
  <label for="itemPrice"><?=$_TXT[54]?></label>
  <input name="item_price" id="priceID" type="text" placeholder="<?=$_TXT[54]?> (DKK)" value="<?php echo $row2['item_price']?>" require>  
</div>
<div>
  <label for="itemInstock"><?=$_TXT[55]?></label>
  <input name="instock" id="stockID" type="text" placeholder="<?=$_TXT[55]?>" value="<?php echo $row2['item_stock']?>">
</div>
<br>
<div>
    <label for="description"><?=$_TXT[56]?></label>
    <textarea name="description" id="descrID" cols="40" rows="5" placeholder="<?=$_TXT[56]?>" require><?php echo $row2['description']?></textarea>
</div>
<!-- <?php
$data = $row2['item_img'];
    echo '<input type="text" value="' . htmlspecialchars($data) . '" />'."\n";
?> -->
<div>
  <label for="ItemImg"><?=$_TXT[57]?></label>
  <input type="file" name="image">
</div>
<!-- <img src="../images/<?php echo $row2['item_img']?>"> -->
<div>
  <input name="item_id" type="hidden" value="<?php echo $row2['item_id']?>">
</div>
  <button onclick="updateItem()" id="updateButton"><?=$_TXT[60]?></button>  

</form>
<?php
}
?>
</section>

<?php
require_once(__DIR__.'../../components/footer.php');
?>
