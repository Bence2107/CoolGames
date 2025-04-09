<?php
    session_start();
    include_once "../../functions/database.php";
    if(isset($_SESSION["email"])){
        header("Location: profile.php");
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
    <title>Home</title>
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
            <li class="dropdown">
                <a href="profile.php" id="active3">Fiók <i class="fa-solid fa-user">&nbsp;</i></a>
                    <div class="dropdown_content">
                        <a href="log.php" id="active">Bejelentkezés</a><br>
                        <a href="reg.php">Regisztráció</a>
                    </div>
            </li>
        </ul>
    </nav>
</header>
<main>
    <?php
    if (isset($_SESSION['wrong_password'])) {
        echo '<div class="failed">';
            echo "<b>"."Hibás jelszó!" ."</b>";
        echo '</div>';
        unset($_SESSION['wrong_password']);
    }
    else if (isset($_SESSION['invalid_email'])) {
        echo '<div class="failed">';
        echo "<b>"."Hibás E-Mail!" ."</b>";
        echo '</div>';
        unset($_SESSION['invalid_email']);
    }
    else if (isset($_SESSION['userNotFound'])) {
        echo '<div class="failed">';
        echo "<b>"."Nincs ilyen Felhasználó, vagy nem töltötte ki a mezőket!" ."</b>";
        echo '</div>';
        unset($_SESSION['userNotFound']);
    }
    ?>
    <div class="inner_main">
        <div id="form_box">
            <h2>Bejelentkezés</h2>
            <form method="post" action="../../functions/profile/login.php">
                <div class="input_field">
                    <input type="text" placeholder="Email" name="email">
                </div>
                <div class="input_field">
                    <input type="password" placeholder="Jelszó" name="passwd">
                </div>
                <input type="submit" value="Bejelentkezés">
            </form>
            <div id="register_link">
                <p>Ha még nem Regisztráltál, <a href="reg.php">itt</a> megteheted!</p>
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