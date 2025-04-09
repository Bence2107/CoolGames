<?php
    session_start();
    $_SESSION["games"] = true;
    include_once "../functions/database.php";
    include_once "../functions/profile/profileData.php";
    include_once "../functions/game/gameQueries.php";
    if(!isset($_SESSION['email'])){
        header("Location: profile/log.php");
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="icon" href="../img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Játékok</title>
</head>
<body>
<header>
    <img src="../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../index.php">Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="news.php">Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="games.php" id="active">Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="basket.php">Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
            <?php
            if(!isset($_SESSION["email"])){
                ?>
                <li class="dropdown">
                    <a href="../pages/profile/profile.php">Fiók <i class="fa-solid fa-user">&nbsp;</i></a>
                    <div class="dropdown_content">
                        <a href="../pages/profile/log.php">Bejelentkezés</a><br>
                        <a href="../pages/profile/reg.php">Regisztráció</a>
                    </div>
                </li>
                <?php
            } else{
                if($currentUserData[6]!=null){
                    echo '<li>
                                <a href="profile/profile.php"><img class="header_avatar" src="data:image/jpeg;base64,'.base64_encode($currentUserData[6]).'" alt=""></a><p>'.$currentUserData[7]. '&#128008;</p>
                            </li>';
                }
                else{
                    echo '<li><a href="profile/profile.php"><img src="../img/profile/profilePicture.png" alt="" class="header_avatar"></a> <p>'.$currentUserData[7]. '&#128008;</p> </li>';
                }
            }
            ?>
        </ul>
    </nav>
</header>
<main>
    <?php
    if (isset($_SESSION['addToBasketSuccessfull'])) {
        echo '<div class="successfull">';
        echo "<b>"."Játék kosárhoz adva!" ."</b>";
        echo '</div>';
        unset($_SESSION['addToBasketSuccessfull']);
    }
    else if (isset($_SESSION['ratingSuccess'])) {
        echo '<div class="successfull">';
        echo "<b>"."Játék értékelve! 5 pont hozzáadva az egyenleghez!" ."</b>";
        echo '</div>';
        unset($_SESSION['ratingSuccess']);
    }
    else if (isset($_SESSION['alreadyInBasket'])) {
        echo '<div class="failed">';
        echo "<b>"."A Játék már a kosárhoz van adva!" ."</b>";
        echo '</div>';
        unset($_SESSION['alreadyInBasket']);
    }
    else if (isset($_SESSION['ownedGame'])) {
        echo '<div class="failed">';
        echo "<b>"."Ezt Játékot már birtokolja!" ."</b>";
        echo '</div>';
        unset($_SESSION['ownedGame']);
    }
    else if (isset($_SESSION['alreadyRated'])) {
        echo '<div class="failed">';
        echo "<b>"."Ezt Játékot már értékelte!" ."</b>";
        echo '</div>';
        unset($_SESSION['alreadyRated']);
    }
    else if (isset($_SESSION['notOwnedRate'])) {
        echo '<div class="failed">';
        echo "<b>"."Ahhoz hogy értékelni tudja a játékot, először meg kell vásárolnia!" ."</b>";
        echo '</div>';
        unset($_SESSION['notOwnedRate']);
    }
    ?>
    <div class="inner_main">
        <div class="inner">
            <h1 id="title">Top 3 Legjobb Játékunk:</h1>
            <div class="games_container">
                <?php
                while (($gameData = mysqli_fetch_assoc($top3GameQuery))!= null) {
                    echo '<div class="game">';
                    echo ' <a href="game.php?name='.urlencode($gameData['nev']).'"><img src="../img/assets/games/' .$gameData['id']. '.jpg" alt=""></a>';
                    echo ' <h3> ' . $gameData['nev'];
                    echo '<br>';
                    echo '<span>' .$gameData['ar']. '&#128008;</span>';
                    echo ' </h3>';
                    echo ' </div>';
                }
                ?>
            </div>

            <h1 id="title2">Összes Játékunk:</h1>
            <div class="games_container">
                <?php
                while (($gameData = mysqli_fetch_assoc($gamesQuery))!= null) {
                    echo '<div class="game">';
                        echo ' <a href="game.php?name='.urlencode($gameData['nev']).'"><img src="../img/assets/games/' .$gameData['id']. '.jpg" alt=""></a>';
                        echo ' <h3> ' . $gameData['nev'];
                            echo '<br>';
                            echo '<span>' .$gameData['ar']. '&#128008;</span>';
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