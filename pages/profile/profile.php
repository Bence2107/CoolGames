<?php
    session_start();
    include_once "../../functions/database.php";
    include_once "../../functions/profile/profileData.php";
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
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Profil</title>
</head>
<body>
<header>
    <img src="../../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../../index.php">Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="../news.php">Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="../games.php">Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="../basket.php">Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
            <?php
            if(!isset($_SESSION["email"])){
                ?>
                <li class="dropdown">
                    <a href="../../pages/profile/profile.php">Fiók <i class="fa-solid fa-user">&nbsp;</i></a>
                    <div class="dropdown_content">
                        <a href="../../pages/profile/log.php">Bejelentkezés</a><br>
                        <a href="../../pages/profile/reg.php">Regisztráció</a>
                    </div>
                </li>
                <?php
            } else{
                if($currentUserData[6]!=null){
                    echo '<li>
                                <a href="profile.php"><img class="header_avatar" src="data:image/png;base64,'.base64_encode($currentUserData[6]).'" alt="" id="active2"></a><p>'.$currentUserData[7]. '&#128008;</p>
                            </li>';
                }
                else{
                    echo '<li><a href="profile.php"><img src="../../img/profile/profilePicture.png" alt="" id="active2" class="header_avatar"></a> <p>'.$currentUserData[7]. '&#128008;</p> </li>';
                }
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
                        <?php
                        if($currentUserData[6]!=null){
                            echo '<img class="profile_pick" src="data:image/jpeg;base64,'.base64_encode($currentUserData[6]).'" alt="">';
                        }
                        else{
                            echo '<img src="../../img/profile/profilePicture.png" alt="" class="profile_pick">';
                        }
                        ?>
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
                    <div class="profile_data">
                        <b>Aktuális MacskaKredit:</b>
                        <?php
                        echo "<p>". $currentUserData[7] . "&#128008;</p>";
                        ?>
                    </div>
                    <hr>
                    <div class="profile_buttons">
                        <button onclick="location.href='profile_edit.php'">Profil szerkesztése</button>
                        <form method="post" id="logOut" action="../../functions/profile/actions/logout.php">
                            <input id="warning" type="submit" value="Kijelentkezés">
                        </form>
                    </div>
                </div>
            </div>
            <h1 id="title">Játékaim:</h1>
            <div class="games_container">
                <?php
                if(mysqli_num_rows($ownGamesQuery)==0){
                    echo '<div class="empty_sign">';
                        echo '<h3>Ön még egy játéknak sem a tulajdonosa. Hogy birtokoljon, látogasson el a Játékok Weboldalra:</h3>';
                        echo ' <div class="action">';
                            echo '<form action="../games.php">';
                                echo '<input type="submit" value="Játékok vásárlása">';
                            echo  '</form>';
                        echo '</div>';
                    echo '</div>';
                }

                while (($gameData = mysqli_fetch_assoc($ownGamesQuery))!= null) {
                    echo '<div class="game">';
                    echo ' <a href="../game.php?name='.urlencode($gameData['nev']).'"><img src="../../img/assets/games/' .$gameData['id']. '.jpg" alt=""/></a>';
                    echo ' <h3> ' . $gameData['nev'];
                    echo ' </h3>';
                    echo ' </div>';
                }
                ?>
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