<?php
$_title = 'Sign in';
require_once(__DIR__.'../../components/header.php');

session_start();
if (!isset($_SESSION["lang"])) { $_SESSION["lang"] = "en"; }
if (isset($_POST["lang"])) { $_SESSION["lang"] = $_POST["lang"]; }

require "../lan/lang." . $_SESSION["lang"] . ".php";

?>
<body>
    <nav id="signInNav">
        <div id="logoblack">
        <a href="../home/home.php"><img src="../image/amazonBlack.png" id="signLogo"alt=""></a>           
        </div>
    </nav>

    <main>
        <section id="signUP">
            <section id="smallersignin">
                <div id="sign">
                    <form  onsubmit="return validate_signIN(); false">
                    <h1 id="lightFont"><?=$_TXT[72]?></h1>
                    <h4><?=$_TXT[65]?>:</h4>
                    <input name="email" id="emailID" type="text" placeholder="email" require>
                    <h4><?=$_TXT[66]?>:</h4>
                    <input name="password" id="passID" type="password" placeholder="password" require>
                    <button class="continueButton" onclick="login()"><?=$_TXT[73]?></button>
                    </form>
                    <p id="newAmazon"><span><?=$_TXT[74]?></span></p>
                    <button id="createButton" onclick="document.location='../signup/signup.php'"><?=$_TXT[75]?></button>


                </div>
                    <form id="from_lan" method="post">
                    <input class="button_lan" type="submit" name="lang" value="en"/>
                    <input class="button_lan" type="submit" name="lang" value="ga"/>
                    </form>    
            </section>
        </section>

    </main>


<?php
require_once(__DIR__.'../../components/footer.php');
?>
