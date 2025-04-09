<?php
    session_start();
    $currentUserData = null;
    include "../../functions/database.php";
    include "../../functions/profile/actions/profileData.php";
    if(!isset($_SESSION["email"])){
        header("Location: log.php");
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="icon" href="../../img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/fa_script.js" crossorigin="anonymous"></script>
    <title>Profil</title>
</head>
<body>
<header>
    <img src="../../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../../index.php">Főoldal <i class="fa-solid fa-house"></i></a></li>
            <li><a href="../news.php">Hírek <i class="fa-solid fa-newspaper"></i></a></li>
            <li><a href="../games.php" id="active">Játékok <i class="fa-solid fa-gamepad"></i></a></li>
            <li><a href="../basket.php">Kosár <i class="fa-solid fa-cart-shopping"></i></a></li>
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
            <div class="profile_container">
                <div class="profile_pick_container">
                    <div class="profile_buttons">
                        <img src="../../img/profile/profilePicture.png" alt="" class="profile_pick">
                    </div>
                </div>
                <div class="profile_data_container">
                    <h1>Fiók</h1>
                    <div class="profile_data">
                        <b>Email:</b>
                        <?php
                            echo "<p>". $currentUserData[0] ."</p>";
                        ?>
                    </div>
                    <div class="profile_data">
                        <b>Felhasználónév:</b>
                        <?php
                            echo "<p>". $currentUserData[1] ."</p>";
                        ?>
                    </div>
                    <div class="profile_data">
                        <b>Név:</b>
                        <?php
                            echo "<p>". $currentUserData[2] . " " . $currentUserData[3]."</p>";
                        ?>
                    </div>
                    <div class="profile_data">
                        <b>Születési Dátum:</b>
                        <?php
                            echo "<p>". $currentUserData[5] ."</p>";
                        ?>
                    </div>
                    <hr>
                    <div class="profile_buttons">
                        <button onclick="location.href='profile_edit.php'">Profil szerkesztése</button>
                        <form method="post" id="logOut" action="../../functions/profile/actions/logout.php">
                            <input type="submit" value="Kijelentkezés">
                        </form>
                    </div>
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