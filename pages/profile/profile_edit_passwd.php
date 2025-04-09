<?php
    session_start();
    $currentUserData = null;
    include "../../functions/database.php";
    include "actions/profileData.php";
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
    <title>Profil törlése</title>
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
        echo "<b>"."Jelszó módosítva!" . "</b>";
        echo '</div>';
        unset($_SESSION["successfull"]);
    }
    ?>
    <div class="inner_main">
            <div id="form_box">
                <h2>Jelszó módosítása</h2>
                <form method="post" action="../../functions/profile/actions/password_modify.php">
                    <div class="input_field">
                        <input type="password" placeholder="Jelenlegi Jelszó" name="passwd">
                        <div class="error">
                            <?php
                                if(in_array("empty_password",$errors)){
                                    echo "<b>"."Kérem adja meg a mostani Jelszavát! "."</b>";
                                }
                                if(in_array("wrong_passwd",$errors)){
                                    echo "<b>"."Hibás jelszó! Kérem próbálja újra! "."</b>";
                                }

                            ?>
                        </div>
                    </div>

                    <div class="input_field">
                        <input type="password" placeholder="Új Jelszó" name="newpasswd">
                        <div class="error">
                            <?php
                                if(in_array("empty_newpassword",$errors)){
                                    echo "<b>"."Kérem adja meg a mostani Jelszavát! "."</b>";
                                }
                                if(in_array("new_passwd_not_equal",$errors)){
                                    echo "<b>"."A két jelszó nem egyezik. Kérem próbálja újra! "."</b>";
                                }
                            ?>
                        </div>
                    </div>

                    <div class="input_field">
                        <input type="password" placeholder="Új Jelzó Újra" name="newpasswdagain">
                        <div class="error">
                            <?php
                                if(in_array("empty_newpasswordagain",$errors)){
                                    echo "<b>"."Kérem adja meg a mostani Jelszavát! "."</b>";
                                }
                                if(in_array("new_passwd_not_equal",$errors)){
                                    echo "<b>"."A két jelszó nem egyezik. Kérem próbálja újra! "."</b>";
                                }
                            ?>
                        </div>
                    </div>

                    <input type="submit" value="Jelszó módosítása">
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