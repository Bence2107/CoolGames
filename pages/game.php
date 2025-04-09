<?php
    session_start();
    $_SESSION["games"] = true;
    include_once "../functions/database.php";
    include_once "../functions/profile/profileData.php";
    include_once "../functions/game/gameQueries.php";
    $gameID = $gameData['id'];
    if(!isset($_SESSION['email'])){
        header("Location: profile/log.php");
    }
    $istheGameRated = mysqli_query($con, "SELECT * FROM ertekel WHERE jatek_id='$gameID'");
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
                    <a href="../pages/profile/profile.php">Fiók <i class="fa-solid fa-user"></i></a>
                    <div class="dropdown_content">
                        <a href="../pages/profile/log.php">Bejelentkezés</a><br>
                        <a href="../pages/profile/reg.php">Regisztráció</a>
                    </div>
                </li>
                <?php
            } else{
                if($currentUserData[6]!=null){
                    echo '<li>
                                <a href="profile/profile.php"><img class="header_avatar" src="data:image/png;base64,'.base64_encode($currentUserData[6]).'" alt=""></a><p>'.$currentUserData[7]. '&#128008;</p>
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
    <div class="inner_main">
        <div class="inner">
            <h1 id="title"><?php echo $gameData['nev']?></h1>
            <div class="content" id="game">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($gameData['kep']).'" alt="">'?>
                <div>
                    <div id="rating_container">
                        <?php
                        if(mysqli_num_rows($istheGameRated)>0){
                            echo '<h1>Értékelés: ' . round($gameData['ertekeles'],1) . '</h1>';
                        }
                        else{
                            echo '<h1>Eredeti Értékelés: ' .round($gameData['eredeti_ertekeles'],1) . '</h1>';
                        }
                        ?>

                    </div>
                    <h3>Megjelenés:</h3><p><?php echo $gameData['megjelenes_datum']?></p>
                    <h3>Fejlesztő:</h3><p><?php echo $gameData['fejleszto']?></p>
                    <h3>Kiadó:</h3><p><?php echo $gameData['kiado']?></p>
                    <h3>Műfaj:</h3><p><?php echo $gameData['mufaj']?></p>
                    <hr>
                    <h2>Rövid Leírás:</h2>
                    <p><?php echo nl2br($gameData["r_leiras"])?>
                    </p>
                </div>
                    <?php echo '<iframe class="video" src="'.$gameData["video_link"].'" allowfullscreen ></iframe>'?>
                <h2>A Játékról:</h2>
                <p><?php echo nl2br($gameData['h_lerias'])?></p>
                <div>
                    <div id="gameTier">
                        <form method="post" action="../functions/game/gameRate.php?id='<?php echo $gameData['id'] ?>'">
                            <h2>Játék értékelése:</h2>
                            <label>
                                <input type="number" name="rating" min="0" max="10" onkeydown="return false">
                            </label>
                            <input type="submit" value="Küldés">
                        </form>
                    </div>
                    <div class="game_buy_sign">
                        <h4>A(z) <?php echo $gameData['nev']?> megvásárlása</h4>
                        <div id="price">
                            <p><?php echo $gameData['ar']?></p> &#128008;
                            <div>
                                <form method="post" action="../functions/game/gameToBasket.php">
                                    <input type="hidden" value="<?php echo $currentUserData['email'] ?>" name="email">
                                    <input type="hidden" value="<?php echo $gameData['id'] ?>" name="jatekID">
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
</body>
</html>