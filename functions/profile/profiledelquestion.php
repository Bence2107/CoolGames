<?php
    session_start();
    include "../database.php";
    $currentUserData = null;
    include "actions/profileData.php";
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="icon" href="../../img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/fa_script.js" crossorigin="anonymous"></script>
    <title>Profil törlése</title>
</head>
<body>
<header>
    <img src="../../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../../index.php">Főoldal <i class="fa-solid fa-house"></i></a></li>
            <li><a href="../../pages/news.php">Hírek <i class="fa-solid fa-newspaper"></i></a></li>
            <li><a href="../../pages/games.php">Játékok <i class="fa-solid fa-gamepad"></i></a></li>
            <li><a href="../../pages/basket.php">Kosár <i class="fa-solid fa-cart-shopping"></i></a></li>
            <?php
            if(!isset($_SESSION["email"])){
                ?>
                <li class="dropdown">
                    <a href="../../pages/profile/profile.php">Fiók <i class="fa-solid fa-user"></i></a>
                    <div class="dropdown_content">
                        <a href="../../pages/profile/log.php">Bejelentkezés</a><br>
                        <a href="../../pages/profile/reg.php">Regisztráció</a>
                    </div>
                </li>
                <?php
            } else{

                ?>
                <a href="../../pages/profile/profile.php"><img src=../../img/profile/profilePicture.png alt="" class="header_avatar"></a>
                <?php
            }
            ?>
        </ul>
    </nav>
</header>
<main>
    <div class="inner_main">
        <div class="inner">
            <div class="window">
                <p>Biztosan törölni szeretné, ezt a profilt, és minden hozzátartozó információt?: </p>
                <b> <?php echo $currentUserData[1];?></b><br>
                <div class="profile_buttons" id="windows">
                    <button id="window_yes" onclick="location.href='actions/delProfile.php'">Igen</button>
                    <button id=window_no onclick="location.href='../../pages/profile/profile_edit.php'">Nem</button>
                </div>

            </div>
        </div>
    </div>
</main>
<footer>
    <hr>
    <div>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">2024 PORT:3306&#169;</a>
    </div>
</footer>
</body>
</html>