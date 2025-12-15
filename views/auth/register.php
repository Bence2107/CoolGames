<?php
$errors = [];
if (isset($_SESSION["errors"])) {
    $errors = $_SESSION["errors"];
}
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="/img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Regisztráció</title>
</head>
<body>
<header>
    <img src="/img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="/index">Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="/news">Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="/games">Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="/basket">Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
            <li class="dropdown">
                <a href="/profile" id="active">Fiók <i class="fa-solid fa-user">&nbsp;</i></a>
                <div class="dropdown_content">
                    <a href="/auth/login">Bejelentkezés</a><br>
                    <a href="/auth/register" id="active3">Regisztráció</a>
                </div>
            </li>
        </ul>
    </nav>
</header>
<main>
    <div class="inner_main">
        <div id="form_box">
            <h2>Regisztráció</h2>
            <form method="post" action="/auth/register">
                <div class="input_field">
                    <label for="id">
                        <input type="email" placeholder="Email" id="id" name="email">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("empty_email", $errors)) {
                            echo "<b>Kérem adja meg az E-mail címét!</b>";
                        }
                        if (in_array("invalid_email", $errors)) {
                            echo "<b>Kérem adjon meg egy helyes E-mail címet!</b>";
                        }
                        if (in_array("email_already_exists", $errors)) {
                            echo "<b>Ez az E-mail foglalt. Kérem válasszon másikat!</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <label for="surname">
                        <input type="text" placeholder="Vezetéknév" id="surname" name="surname">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("empty_surname", $errors)) {
                            echo "<b>Kérem adja meg a vezetéknevét!</b>";
                        }
                        if (in_array("long_surname", $errors)) {
                            echo "<b>Túl hosszú vezetéknév. Kérem adjon meg egy rövidebbet</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <label for="first_name">
                        <input type="text" placeholder="Keresztnév" id="first_name" name="first_name">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("empty_first_name", $errors)) {
                            echo "<b>Kérem adja meg a keresztnevét!</b>";
                        }
                        if (in_array("long_first_name", $errors)) {
                            echo "<b>Túl hosszú keresztnév. Kérem adjon meg egy rövidebbet!</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <label for="username">
                        <input type="text" placeholder="Felhasználónév" id="username" name="username">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("empty_username", $errors)) {
                            echo "<b>Kérem adjon meg egy felhasználónevet!</b>";
                        }
                        if (in_array("username_already_exists", $errors)) {
                            echo "<b>Ez a felhasználónév már létezik. Kérem válasszon másikat!</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <label for="password">
                        <input type="password" placeholder="Jelszó (min. 7 karakter, betű, szám)" id="password" name="password">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("empty_password", $errors)) {
                            echo "<b>Kérem írjon be egy jelszót!</b>";
                        }
                        if (in_array("short_password", $errors)) {
                            echo "<b>Kérem írjon be egy hosszabb jelszót!</b>";
                        }
                        if (in_array("wrong_characters", $errors)) {
                            echo "<b>Kérem használjon kis vagy nagy betűket, valamint számokat!</b>";
                        }
                        if (in_array("passwords_not_match", $errors)) {
                            echo "<b>A két jelszó nem egyezik! Kérem próbálja újra!</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <label for="password_again">
                        <input type="password" placeholder="Jelszó újra" id="password_again" name="password_again">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("empty_password_again", $errors)) {
                            echo "<b>Kérem írja be újra a jelszót!</b>";
                        }
                        if (in_array("passwords_not_match", $errors)) {
                            echo "<b>A két jelszó nem egyezik! Kérem próbálja újra!</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <label for="birth_date">
                        <input type="date" id="birth_date" name="birth_date">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("empty_birth_date", $errors)) {
                            echo "<b>Kérem adja meg a születési dátumát!</b>";
                        }
                        if (in_array("invalid_year", $errors)) {
                            echo "<b>Kérem adjon meg egy helyes dátumot!</b>";
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
