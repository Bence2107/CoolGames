<?php
    session_start();
    include "../functions/database.php";
    if(!isset($_SESSION['email'])){
        header("Location: profile/log.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="icon" href="../img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/fa_script.js" crossorigin="anonymous"></script>
    <title>Kosár</title>
</head>
<body>
<header>
    <img src="../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../index.php">Főoldal <i class="fa-solid fa-house"></i></a></li>
            <li><a href="news.php">Hírek <i class="fa-solid fa-newspaper"></i></a></li>
            <li><a href="games.php">Játékok <i class="fa-solid fa-gamepad"></i></a></li>
            <li><a href="basket.php" id="active">Kosár <i class="fa-solid fa-cart-shopping"></i></a></li>
            <?php
            if(!isset($_SESSION["email"])){
                ?>
                <li class="dropdown">
                    <a href="../pages/profile/profile.php">Fiók <i class="fa-solid fa-user"></i></a>
                    <div class="dropdown_content">
                        <a href="../pages/profile/log.php">Bejelentkezés</a><br>
                        <a href="../pages/profile/reg.php">Regisztráció</a>
                    </div>
                </li>
                <?php
            } else{

                ?>
                <a href="../pages/profile/profile.php"><img src=../img/profile/profilePicture.png alt="" class="header_avatar"></a>
                <?php
            }
            ?>
        </ul>
    </nav>
</header>
<main>
    <div class="inner_main">
        <div class="inner">
            <h1 id="title">Kosár</h1>
            <hr>
            <div class="checkOut">
                <div class="checkOut_item">
                    <img src="../img/games/gameexample.jpg" alt="">
                    <a href="game.php">The Last of Us: Part II.</a>
                    <p>30 &#128008;</p>
                    <form>
                        <input type="submit" value="Törlés">
                    </form>
                </div>
                <div class="checkOut_item">
                    <img src="../img/games/gameexample2.jpg" alt="">
                    <a href="game.php">The Witcher 3</a>
                    <p>20 &#128008;</p>
                    <form>
                        <input type="submit" value="Törlés">
                    </form>
                </div>
            </div>
            <hr>
            <div id="buy">
                <h1>Összesen:</h1>
                <p>50 &#128008;</p>
                <form>
                    <input type="submit" value="Vásárlás">
                </form>
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