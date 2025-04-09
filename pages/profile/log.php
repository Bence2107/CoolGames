<?php
    session_start();
    include "../../functions/database.php";
    $errors = [];
    if(isset($_SESSION["errors"])){
        $errors = $_SESSION["errors"];
    }
    unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="icon" href="../../img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/fa_script.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
<header>
    <img src="../../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../../index.php">Főoldal <i class="fa-solid fa-house"></i></a></li>
            <li><a href="../news.php">Hírek <i class="fa-solid fa-newspaper"></i></a></li>
            <li><a href="../games.php">Játékok <i class="fa-solid fa-gamepad"></i></a></li>
            <li><a href="../basket.php">Kosár <i class="fa-solid fa-cart-shopping"></i></a></li>
            <li class="dropdown">
                <a href="profile.php" id="active">Fiók <i class="fa-solid fa-user"></i></a>
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
if (isset($_SESSION['login_failed']) && $_SESSION['login_failed']) {
    echo '<div class="failed">';
        if(in_array("invalid_email",$errors)){
            echo "<b>"."Hibás E-mail!"."</b>";
        }
        if(in_array("hibas",$errors)){
            echo "<b>"."Hibás E-mail vagy jelszó!"."</b>";
        }
    echo '</div>';
    unset($_SESSION['login_failed']);
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