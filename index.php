<?php
    session_start();
    $currentUserData = null;
    include "functions/database.php";
include "functions/profile/actions/profileData.php"
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/fa_script.js" crossorigin="anonymous"></script>
    <title>Főoldal</title>
</head>
<body>
<header>
    <img src="img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="index.php" id="active">Főoldal <i class="fa-solid fa-house"></i></a></li>
            <li><a href="pages/news.php" >Hírek <i class="fa-solid fa-newspaper"></i></a></li>
            <li><a href="pages/games.php">Játékok <i class="fa-solid fa-gamepad"></i></a></li>
            <li><a href="pages/basket.php">Kosár <i class="fa-solid fa-cart-shopping"></i></a></li>

            <?php
                if(!isset($_SESSION["email"])){
                    ?>
            <li class="dropdown">
                <a href="pages/profile/profile.php">Fiók <i class="fa-solid fa-user"></i></a>
                <div class="dropdown_content">
                    <a href="pages/profile/log.php">Bejelentkezés</a><br>
                    <a href="pages/profile/reg.php">Regisztráció</a>
                </div>
            </li>
            <?php
                } else{

            ?>
            <a href="pages/profile/profile.php"><img src="img/profile/profilePicture.png" alt="" class="header_avatar"></a>
                    <?php
                }
            ?>
        </ul>
    </nav>
</header>
<main>
    <div class="inner_main">
        <div class="inner">
            <div class="wallpaper_container">
                <div class="wallpaper_content">
                    <?php
                    if(!isset($_SESSION["email"])){
                        ?>
                    <h2>Üdvözöllek a CoolGames-en!</h2>
                    <?php } else{
                        echo "<h2>Üdvözöllek ". $currentUserData[1] ."!"."</h2>";
                    }

                    if(!isset($_SESSION["email"])){?>
                    <p>Az oldal, ahol "Ingyen" szerezheted be a legújabb játékokat</p>
                    <?php }?>
                    <button onclick="document.getElementById('about').scrollIntoView();">Bővebb információ</button>
                </div>
            </div>
            <div class="content" id="about">
                <h1>Az oldalról</h1>
                <p>Ez az oldal egy Webáruház a legújabb Videójátékok iparában. Az oldal kezdetleges fázisban van, így egyelőre kevés játék áll rendelkezésünkre</p><br>
                <h1>Ár</h1>
                <p>Kis „Cégként” igyekszünk minél elérhetőbb áron adni játékainkat. Erre egy speciális, forradalmi fizetőeszközt használhatnak a felhasználók, ami bárki számára bármikor, és bármennyi elérhető: Macskák &#128008;. A Macskák ugyanis köztudottan régóta, már i.e. 3600-ban is házasítva voltak, így mindennapjaink részévé váltak.</p><br>
                <img src="img/home/cutiecat.jpg" alt="Egy aranyos Cica" title="Ahogy egy még boldog elsős Hallgató a projektén dolgozik, mit sem sejtve mi vár még rá :)" id="cat">
                <h1>Oldalak</h1>
                <ul>
                    <li><p><b>Főoldal</b>: Itt vagy most, és tájékozódsz az oldal működéséről.</p></li>
                    <li><p><b>Hírek:</b> Itt biztosítjuk számodra a legfontosabb híreket Videójátékokról, vagy olyan termékekről, amelyek Videójátékokhoz kapcsolódnak.</p></li>
                    <li><p><b>Játékok:</b> Itt tudsz játékokat vásárolni. <b>Bejelentkezés szükséges!</b></p></li>
                    <li><p><b>Kosár:</b> A megvásárolni kívánt játékaidat itt tudod véglegesen is magádévá tenni. <b>Bejelentkezés szükséges!</b></p></li>
                    <li><p><b>Fiók:</b> Itt találhatod, módosíthatod, akár törőlheted is Fiókod adatait.</p></li>
                </ul>
                <br>
                <h1 id="aboutUs">Rólunk</h1>
                <table>
                    <tr>
                        <th colspan="2">PORT: 3306</th>
                    </tr>
                    <tr>
                        <th><img src="img/home/biraro.jpg" alt="biraromiske" title="Áron" class="profile_picture"></th>
                        <th><img src="img/home/bence2107.png" alt="Bence2107" title="Bence" class="profile_picture"></th>
                    </tr>
                    <tr>
                        <th>Bíró Áron</th>
                        <th>Szabó Bence</th>
                    </tr>
                    <tr>
                        <td>WQBT9A</td>
                        <td>PSOHAF</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</main>
<footer>
    <hr>
    <div>
        <a href="https://www.youtube.com/watch?v=0tOXxuLcaog">2024 PORT:3306&#169;</a>
    </div>
</footer>
<script src="js/script.js"></script>
</body>
</html>