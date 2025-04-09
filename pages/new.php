<?php
    session_start();
    include "../functions/database.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="icon" href="../img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/fa_script.js" crossorigin="anonymous"></script>
    <title>Hírek</title>
</head>
<body>
<header>
    <img src="../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../index.php">Főoldal <i class="fa-solid fa-house"></i></a></li>
            <li><a href="news.php" id="active">Hírek <i class="fa-solid fa-newspaper"></i></a></li>
            <li><a href="games.php">Játékok <i class="fa-solid fa-gamepad"></i></a></li>
            <li><a href="basket.php">Kosár <i class="fa-solid fa-cart-shopping"></i></a></li>
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
            <img src="../img/news/alhir1.jpg" alt="" id="new_image">
            <div class="content">
                <h1 id="new_title">Mégis készül a The Last of Us 3?</h1>
                <br>
                <p>Lehet imádni vagy utálni, de az biztos, hogy a The Last of Us Part I és II a modern játékvilág megkerülhetetlen alkotásai, amiknek folytatására milliók várnak. Akárcsak az HBO-féle TV-sorozat folytatására is. Utóbbi második szezonja, ha lassan is, de biztosan formálódik. Összeállt a stáb, megvannak a szereplők, még idén elkezdődnek a forgatások, jövőre pedig premiert kaphat az HBO The Last of Us sorozatának második szezonja.<br>
                    <br>
                    MI a helyzet a játékokkal?<br>
                    Immár biztos, hogy a Naughty Dog dolgozott egy spinoff játékon, egy multiplayerre fókuszáló The Last of Us epizódon, de ezt aztán törölték, sosem fog már elkészülni. Nem is baj, a legtöbben úgyis a sztorira kíváncsiak és a The Last of Us Part III-at várják már, ami úgy tűnik végre kezd formálódni. A Naughty Dog két napja tett közzé egy 2 órás videót a The Last of Us Part II készítéséről, ami már önmagában is izgalmas és neked is látnod kell, ha csíped a játékot. A vége pedig különösen érdekes,
                    Neil Druckmann ugyanis személyesen mesél a széria jövőjéről. Elmondása szerint mindeddig koncepció szinten sem volt terve a folytatásra,
                    így pedig nem akart belevágni semmibe. De - és ez egy nagy de - ez mostanság megváltozott!<br>
                    <br>
                    Forrás: Esport 1
                </p>
                <hr>
                <p>2024.03.03</p>
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