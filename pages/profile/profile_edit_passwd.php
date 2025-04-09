<?php
    session_start();
    include_once "../../functions/database.php";
    include_once "../../functions/profile/profileData.php";
    if(!isset($_SESSION['email'])){
        header("Location: log.php");
    }
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
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Profil törlése</title>
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
            <?php
            if(!isset($_SESSION["email"])){
                ?>
                <li class="dropdown">
                    <a href="profile.php">Fiók <i class="fa-solid fa-user">&nbsp;</i></a>
                    <div class="dropdown_content">
                        <a href="log.php">Bejelentkezés</a><br>
                        <a href="reg.php">Regisztráció</a>
                    </div>
                </li>
                <?php
            } else{
                if($currentUserData[6]!=null){
                    echo '<li>
                                <a href="profile.php"><img class="header_avatar" src="data:image/png;base64,'.base64_encode($currentUserData[6]).'" alt="" id="active2"></a><p>'.$currentUserData[7]. '&#128008;</p>
                            </li>';
                }
                else{
                    echo '<li><a href="profile.php"><img src="../../img/profile/profilePicture.png" alt="" id="active2" class="header_avatar"></a> <p>'.$currentUserData[7]. '&#128008;</p> </li>';
                }
            }
            ?>
        </ul>
    </nav>
</header>
<main>
    <?php
    if (isset($_SESSION["successfull"])) {
        echo '<div class="successfull">';
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
                </form>
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