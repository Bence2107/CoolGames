<?php
    session_start();
    include "../functions/database.php";
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
    <script src="../js/fa_script.js" crossorigin="anonymous"></script>
    <title>Játékok</title>
</head>
<body>
<header>
    <img src="../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../index.php">Főoldal <i class="fa-solid fa-house"></i></a></li>
            <li><a href="news.php">Hírek <i class="fa-solid fa-newspaper"></i></a></li>
            <li><a href="games.php" id="active">Játékok <i class="fa-solid fa-gamepad"></i></a></li>
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
            <h1 id="title">The Last of Us: Part II.</h1>
            <div class="content" id="game">
                <img src="../img/games/gameexample.jpg" alt="">
                <div>
                    <h3>Megjelenés:</h3><p>2020. június 19.</p>
                    <h3>Fejlesztő:</h3><p>Naughty Dog LLC, Iron Galaxy Studios</p>
                    <h3>Kiadó:</h3><p>PlayStation PC LLC</p>
                    <h3>Műfaj:</h3><p>Lövöldözős, Külső nézetes lövöldözős, Akció-kaland</p>
                    <hr>
                    <h2>Rövid Leírás:</h2>
                    <p>Öt évvel azután, hogy veszélyes úton átkeltek a járvány sújtotta Egyesült Államokon, Ellie és Joel a wyomingi Jackson városában telepedett le. A túlélők virágzó közösségében élve békére és stabilitásra leltek, annak ellenére, hogy a fertőzöttek és más, kétségbeesett túlélők miatt folyamatos fenyegetésben éltek.<br>
                        Mikor egy erőszakos esemény megzavarja a békét, Ellie kemény útra indul, hogy igazságot szolgáltasson és ismét békére leljen. Amint egyesével levadássza a felelősöket, szembe kell néznie tettei szörnyű fizikai és érzelmi következményeivel.
                    </p>
                </div>
                <iframe class="video" src="https://www.youtube.com/embed/vhII1qlcZ4E"></iframe>
                <h2>A Játékról:</h2>
                <p>Éld át az egyre növekvő morális konfliktusokat, amelyeket Ellie kérlelhetetlen bosszúvágya korbácsol fel. A nyomában járó erőszak miatt megkérdőjelezed magadban a helyes és a helytelen fogalmát, a jó és a rossz harcát és a hős vagy gonosztevő megítélését.<br>
                    <br>
                    Gyönyörű, de veszélyes világ:<br>

                    Indulj Ellie kalandjára, amely Jackson békés hegységei és erdőségeiből Seattle benőtt, burjánzó romjai közé vezet. Találkozz túlélők új csoportjaival, ismeretlen és veszélyes környezetben, és fedezd fel a fertőzöttek rémisztő fejlődését.

                    A Naughty Dog legújabb motorja által életre keltett halálos karakterek és világ minden korábbinál valósághűbb és a legapróbb részletig kidolgozott.<br><br>

                    Feszült és kétségbeesett hangulatú túlélős akciójáték<br>

                    Az új, továbbfejlesztett játékrendszerek illenek Ellie útjának élet-halál kérdéseihez az ellenséges világban. Érezd át kétségbeesett küzdelmét a túlélésért a még jobb funkciók segítségével: nagy intenzitású közelharc, folyamatos mozgás és dinamikus lopakodás.<br><br>

                    Fegyverek, tárgyak, képességek és frissítések széles választékával saját játékstílusodhoz igazíthatod Ellie tulajdonságait.</p>
                <div>
                    <div id="gameTier">
                        <form method="post">
                            <h2>Játék értékelése:</h2>
                            <label>
                                <input type="number" min="0" max="10" onkeydown="return false">
                            </label>
                            <input type="submit" value="Küldés">
                        </form>
                    </div>
                    <div class="game_buy_sign">
                        <h4>A The Last of Us: Part II. megvásárlása</h4>
                        <div id="price">
                            <p>59.99</p> &#128008;
                            <div>
                                <form>
                                    <input type="submit" value="Kosárba">
                                </form>
                            </div>
                        </div>
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
<script src="../js/script.js"></script>
</body>
</html>