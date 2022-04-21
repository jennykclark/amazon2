<?php
$_title = 'Best Sellers';
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
    $q = $db->query('SELECT * from items2 LIMIT 10');
}catch(PDOException $e) {
    exit();
}


 
// (D) LOAD LANGUAGE FILE
require "../lan/lang." . $_SESSION["lang"] . ".php";

$base = $db->prepare('SELECT * FROM users WHERE user_id = :userID');
$base->bindValue(":userID", $_SESSION['user']['user_id']);

$base->execute();

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

<main>
    <section id="rightSide">
        <div id="options">
            <div id="Department">
                <h3><?=$_TXT[23]?></h3>
                <p><a href="myItems"><?=$_TXT[24]?></a></p>
                <p><a href="../show_class/class"><?=$_TXT[25]?></a></p>
            </div>
            <div id="price">
                <h3><?=$_TXT[26]?></h3>
                <p><?=$_TXT[27]?></p>
                <p><?=$_TXT[28]?></p>
                <P><?=$_TXT[29]?></P>
                <P><?=$_TXT[30]?></P>
                <P>1.000DKK &amp; above</P>
            </div>

        </div>
    </section>
    <h1><?=$_TXT[31]?></h1>
    <?php 
    while($rows=$q->fetch())
    {
    ?>
    <section id="mainItems">
        <section class="itemClass">
            <div id="imgDiv">
                <div id="imgSize">
                    <img src="../images/<?php echo $rows['item_img'];?>" alt="">
                </div>
            </div>

            <div id="itemInfo">
                <div id="heading">
                    <h1>
                        <?php
                        echo $rows['item_name'];
                        ?>
                    </h1>
                </div>
                <div id="item">
                    <h4>           
                        <?php
                        echo $rows['item_price'];
                        ?> DKK
                        </h4>
                    <p><?=$_TXT[32]?></p>
                    <p><?=$_TXT[33]?></p>
                    <!-- <p>(<?php echo $rows['item_stock'];?> <?$_TXT[34]?>)</p> -->
                    <br>
                    <p>
                    <?php
                        echo $rows['description'];
                    ?>
                    </p>
                </div>

            </div>
        </section>
    </section>
<br>
<?php 
}
?>
</main>

<?php
require_once(__DIR__.'../../components/footer.php');
?>