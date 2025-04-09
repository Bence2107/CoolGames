<?php
    session_start();
    $_SESSION["basket"] = true;
    if(!isset($_SESSION['email'])){
        header("Location: profile/log.php");
    }
    include_once "../functions/database.php";
    include_once "../functions/profile/profileData.php";
    include_once "../functions/basket/basketQueries.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="icon" href="../img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Kosár</title>
</head>
<body>
<header>
    <img src="../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../index.php">Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="news.php">Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="games.php">Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="basket.php" id="active">Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
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
    <?php
    if (isset($_SESSION['notEnoughMoneyError']) && !isset($_SESSION['ownedGame'])) {
        echo '<div class="failed">';
        echo "<b>"."Nincs elég pénze a vásárláshoz!"."</b>";
        echo '</div>';
        unset($_SESSION['notEnoughMoneyError']);
    }
    else if(isset($_SESSION['buySuccessfull'])) {
        echo '<div class="successfull">';
        echo "<b>" . "Sikeres vásárlás!" . "</b>";
        echo '</div>';
        unset($_SESSION['buySuccessfull']);
    }
    ?>
    <div class="inner_main">
        <div class="inner">
            <h1 id="title">Kosár</h1>
            <div class="checkOut">
                <?php
                    if(mysqli_num_rows($basketQuery)==0){
                        echo '<div class="empty_sign">';
                            echo '<img src="../img/basket/trolley_cart_warning_icon.png" alt="">';
                            echo '<h1>A kosara <b>üres</b></h1>';
                            echo '<h3>Amennyiben szeretné megvásárolni a termékeit, kérem először helyezze a kosárba őket</h3>';
                            echo ' <div class="action">';
                            echo '<form action="games.php">';
                                echo '<input type="submit" value="Játékok vásárlása">';
                            echo  '</form>';
                            echo '</div>';
                        echo '</div>';
                    }
                    else{
                        echo '<hr>';
                        while (($basketData = mysqli_fetch_assoc($basketQuery))!= null) {
                            echo ' <div class="checkOut_item">';
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($basketData['kep']).'" alt="">';
                                echo ' <a href="game.php?name='.urlencode($basketData['nev']).'">'.$basketData['nev'].'</a>';
                                echo ' <p>' . $basketData['ar'] . '&#128008;</p>';
                                echo ' <form method="post" action="../functions/game/gameDeleteFromBasket.php">';
                                ?>
                            <input type="hidden" value="<?php echo $currentUserData['email'] ?>" name="email">
                            <input type="hidden" value="<?php echo $basketData['id'] ?>" name="jatekID">
                <?php
                                echo ' <input type="submit" value="Törlés"> ';
                                echo '</form>';
                            echo '</div>';
                        }
                        echo '<hr>';
                        echo ' <div class="action">';
                        echo ' <h1>Összesen:</h1>';
                        echo '<p>'.$price['osszesen_fizetendo']. '&#128008;</p>';
                        echo ' <form method="post" action="../functions/game/gameBuy.php">';
                            echo '<input type="submit" value="Vásárlás">';
                        echo '</form>';
                        echo '<br>';
                        echo '<p>Vásárlásért járó pont: '.$reward.'&#128008;</p>';
                        echo '</div>';
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