<?php

    $pageTitle = 'Regisztráció';
    $activePage = 'profile';
?>

<?php include "views/components/header.php"; ?>
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
                        <input type="password" placeholder="Jelszó (min. 7 karakter, betű, szám)" id="password"
                               name="password">
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

<?php include "views/components/footer.php"; ?>