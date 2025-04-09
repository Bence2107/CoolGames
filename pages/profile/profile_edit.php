<?php
    session_start();
    $currentUserData = null;
    $errors = [];
    include "../../functions/database.php";
    include "../../functions/profile/actions/profileData.php";
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
    <title>Profil szerkesztése</title>
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
            <?php
            if(!isset($_SESSION["email"])){
                ?>
                <li class="dropdown">
                    <a href="profile.php">Fiók <i class="fa-solid fa-user"></i></a>
                    <div class="dropdown_content">
                        <a href="log.php">Bejelentkezés</a><br>
                        <a href="reg.php">Regisztráció</a>
                    </div>
                </li>
                <?php
            } else{

                ?>
                <a href="profile.php"><img src=../../img/profile/profilePicture.png alt="" class="header_avatar"></a>
                <?php
            }
            ?>
        </ul>
    </nav>
</header>
<main>
    <?php
    if (isset($_SESSION["successfull"]) && $_SESSION["successfull"]) {
        echo '<div class="reg_successfull">';
        echo "<b>"."Adatok módosítva!" . "</b>";
        echo '</div>';
        unset($_SESSION["successfull"]);
    }
    ?>
    <div class="inner_main">
        <h1 id="cim">Profil módosítása</h1>
        <div class="inner">
            <div class="profile_buttons">
                <img src="../../img/profile/profilePicture.png" alt="" class="profile_pick_2">
                <form id="form_box">
                    <h2>Profilkép módosítása</h2>
                    <input type="file" name="profile-pic"><br>
                    <button type="submit">Profilkép Feltöltése</button>
                </form>
            </div>
            <div id="form_box">
                <h2>Adatok módosítása</h2>
                <form method="post" action="../../functions/profile/actions/profile_info_change.php">
                    <div class="input_field">
                        <input type="text" placeholder="<?php echo $currentUserData[2] ?>" name="veznev">
                        <div class="error">
                            <?php
                            if(in_array("empty_veznev",$errors)){
                                echo "<b>"."Kérem adja meg a vezetéknevét! "."</b>";
                            }
                            if(in_array("long_veznev",$errors)){
                                echo "<b>"."Túl hosszú vezetéknév. Kérem adjon meg egy rövidebbet "."</b>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="<?php echo $currentUserData[3] ?>" name="kernev">
                        <div class="error">
                            <?php
                            if(in_array("empty_kernev",$errors)){
                                echo "<b>"."Kérem adja meg a keresztnevét! "."</b>";
                            }
                            if(in_array("long_kernev",$errors)){
                                echo "<b>"."Túl hosszú keresztnév. Kérem adjon meg egy rövidebbet!"."</b>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="<?php echo $currentUserData[1] ?>" name="username">
                        <div class="error">
                            <?php
                            if(in_array("empty_username",$errors)){
                                echo "<b>"."Kérem adjon meg egy felhasználónevet! "."</b>";
                            }
                            if(in_array("username_contatins",$errors)){
                                echo "<b>"."Ez a felhasználónév már létezik. Kérem válasszon másikat!"."</b>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="input_field">
                        <input type="date" name="szul_datum">
                        <div class="error">
                            <?php
                            if(in_array("empty_szul_datum",$errors)){
                                echo "<b>"."Kérem adjon meg egy dátumot! "."</b>";
                            }
                            ?>
                        </div>
                    </div>


                    <input type="submit" value="Módosít">
                </form>
        </div>
            <div class="profile_buttons">
                <button onclick="location.href='password_change.php'">Jelszó módosítása</button>
                <button onclick="location.href='profiledelquestion.php'">Profil törlése</button>
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