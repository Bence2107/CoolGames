<?php
    session_start();
    include_once "../../functions/database.php";
    if(isset($_SESSION["email"])){
        header("Location: profile.php");
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
                <a href="profile.php" id="active">Fiók <i class="fa-solid fa-user"></i></a>
                <div class="dropdown_content">
                    <a href="log.php">Bejelentkezés</a><br>
                    <a href="reg.php" id="active">Regisztráció</a>
                </div>
            </li>
        </ul>
    </nav>
</header>
<main>
<?php
    if (isset($_SESSION['registration_success'])) {
        echo '<div class="successfull">';
            echo "<b>"."Sikeres regisztráció!" ."<br>"."Kérem jelentkezzen be!"."</b>";
        echo '</div>';
        unset($_SESSION['registration_success']);
    }
?>
    <div class="inner_main">
        <div id="form_box">
            <h2>Regisztráció</h2>
            <form method="post" action="../../functions/profile/registration.php">
                <div class="input_field">
                    <input type="email" placeholder="Email" name="email">
                    <div class="error">
                        <?php
                        if(in_array("empty_email",$errors)){
                            echo "<b>"."Kérem adja meg az E-mail címét! "."</b>";
                        }
                        if(in_array("helytelen_email",$errors)){
                            echo "<b>"."Kérem adjon meg egy helyes E-mail címet! "."</b>";
                        }
                        if(in_array("email_contains",$errors)){
                            echo "<b>"."Ez az E-mail foglalt. Kérem válasszon másikat! "."</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <input type="text" placeholder="Vezetéknév" name="veznev">
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
                    <input type="text" placeholder="Keresztnév" name="kernev">
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
                    <input type="text" placeholder="Felhasználónév" name="username">
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
                    <input type="password" placeholder="Jelszó (min. 7 karakter)" name="password">
                    <div class="error">
                        <?php
                        if(in_array("empty_password",$errors)){
                            echo "<b>"."Kérem írjon be egy jelszót! "."</b>";
                        }
                        if(in_array("short_password",$errors)){
                            echo "<b>"."Kérem írjon be egy hosszabb jelszót! "."</b>";
                        }
                        if(in_array("wrong_character",$errors)){
                            echo "<b>"."Kérem ne használjon speciális karaktereket! "."</b>";
                        }
                        if(in_array("passwords_not_match",$errors)){
                            echo "<b>"."A két jelszó nem egyezik! Kérem próbálja újra! "."</b>";
                        }
                        if(in_array("password_contains",$errors)){
                            echo "<b>"."Ezzel a jelszóval már regisztráltak. Kérem válasszon másikat! "."</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="Jelszó újra" name="passwdagain">
                    <div class="error">
                        <?php
                        if(in_array("empty_passwordagain",$errors)){
                            echo "<b>"."Kérem írja be újra a jelszót! "."</b>";
                        }
                        if(in_array("passwords_not_match",$errors)){
                            echo "<b>"."A két jelszó nem egyezik! Kérem próbálja újra! "."</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <input type="date" name="szul_datum">
                    <div class="error">
                        <?php
                        if(in_array("invalid_year",$errors)){
                            echo "<b>"."Kérem adjon meg egy helyes dátumot! "."</b>";
                        }
                        ?>
                    </div>
                </div>


                <input type="submit" value="Regisztráció">
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