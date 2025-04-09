<?php
    session_start();
    include_once "functions/database.php";
    if(isset($_SESSION["email"])){
        include_once "functions/profile/profileData.php";
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Főoldal</title>
</head>
<body>
<header>
    <img src="img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="index.php" id="active">Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="pages/news.php" >Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="pages/games.php">Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="pages/basket.php">Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
            <?php
                if(!isset($_SESSION["email"])){
                    ?>
            <li class="dropdown">
                <a href="pages/profile/profile.php">Fiók <i class="fa-solid fa-user">&nbsp;</i></a>
                <div class="dropdown_content">
                    <a href="pages/profile/log.php">Bejelentkezés</a><br>
                    <a href="pages/profile/reg.php">Regisztráció</a>
                </div>
            </li>
            <?php
                } else{
                    if($currentUserData[6]!=null){
                        echo '<li>
                                <a href="pages/profile/profile.php"><img class="header_avatar" src="data:image/png;base64,'.base64_encode($currentUserData[6]).'" alt=""></a><p>'.$currentUserData[7]. '&#128008;</p>
                            </li>';
                    }
                    else{
                        echo '<li><a href="pages/profile/profile.php"><img src="img/profile/profilePicture.png" alt="" class="header_avatar"></a> <p>'.$currentUserData[7]. '&#128008;</p> </li>';
                    }
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
                    <h2>Üdvözlünk a CoolGames-en!</h2>
                    <?php } else{
                        echo "<h2>Üdvözöllek ". $currentUserData[1] ."!"."</h2>";
                    }
                    if(!isset($_SESSION["email"])){?>
                    <p>Az oldal, ahol "Ingyen" szerezheted be a legújabb játékokat</p>
                    <?php }?>
                    <button>Bővebb információ</button>
                </div>
            </div>
            <div class="content" id="about">
                <h1>Az oldalról</h1>
                <p>Ez az oldal egy Webáruház a legújabb Videójátékok iparában. Az oldal kezdetleges fázisban van, így egyelőre kevés játék áll rendelkezésünkre</p><br>
                <h1>Ár</h1>
                <p>Kis „Cégként” igyekszünk minél elérhetőbb áron adni játékainkat. Erre egy speciális, forradalmi fizetőeszközt használhatnak a felhasználók, ami bárki számára bármikor, és bármennyi elérhető: a MacskaKredit &#128008;. A Macskák ugyanis köztudottan régóta, már i.e. 3600-ban is házasítva voltak, így mindennapjaink részévé váltak.</p><br>
                <img src="img/home/cutiecat.jpg" alt="Egy aranyos Cica" title="Ahogy egy még boldog elsős Hallgató a projektén dolgozik, mit sem sejtve mi vár még rá :)" id="cat">
                <h1>Oldalak</h1>
                <ul>
                    <li><p><b>Főoldal</b>: Itt van most, és tájékozódsz az oldal működéséről.</p></li>
                    <li><p><b>Hírek:</b> Itt biztosítjuk számára a legfontosabb híreket Videójátékokról, vagy olyan termékekről, amelyek Videójátékokhoz kapcsolódnak.</p></li>
                    <li><p><b>Játékok:</b> Itt tud játékokat vásárolni: <b>(Bejelentkezés szükséges!)</b></p>
                        <p>Minden játék vásárlása után a játék árának 15%-át visszaadjuk, így garantáltan jut hozzád elég MacskaKredit &#128008;.
                        Ezen felül minden játék értékelésekor 5&#128008; ingyen MacskaKreditet kínálunk minden értékelő játékosnak. Ezzel azt biztosítjátok, hogy biztosan kapjunk
                            visszajelzést, milyen játékokat kínáljunk játékosaink számára. Fontos, hogy <b>egy játékot csak egyszer</b> lehet értékelni.</p>

                    </li>
                    <li><p><b>Kosár:</b> A megvásárolni kívánt játékaidat itt tudja véglegesen is magádévá tenni <b>Bejelentkezés szükséges!</b></p>
                        <p>Csak a nem birtokolt játékot lehet megvásárolni.</p>
                    </li>
                    <li><p><b>Fiók/Profil:</b> Itt találja, módosíthatja, akár törölheti Fiókja adatait. Utóbbi <q>örökre el fog veszni (ami hosszú idő)!</q> - <em>Minecraft</em> </p></li>
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
<script src="js/index.js"></script>
</body>
</html>