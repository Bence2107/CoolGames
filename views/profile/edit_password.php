<?php

    $pageTitle = "Profil szerkesztése - Jelszó módosítása";
    $activePage = "profile";
?>

<?php include "views/components/header.php"; ?>
<main>
    <?php if (isset($_SESSION["successful"])): ?>
        <div class="successful">
            <b>Jelszó módosítva!</b>
        </div>
        <?php unset($_SESSION["successful"]); ?>
    <?php endif; ?>

    <div class="inner_main">
        <div id="form_box">
            <h2>Jelszó módosítása</h2>
            <form method="post" action="/profile/edit/password">
                <div class="input_field">
                    <label for="old_password">
                        <input type="password" placeholder="Jelenlegi Jelszó" id="old_password" name="old_password">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("wrong_password", $errors)) {
                            echo "<b>Hibás jelszó! Kérem próbálja újra!</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <label for="new_password">
                        <input type="password" placeholder="Új Jelszó" name="new_password">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("passwords_not_equal", $errors)) {
                            echo "<b>A két jelszó nem egyezik. Kérem próbálja újra!</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <label for="new_password_confirm">
                        <input type="password" placeholder="Új Jelszó Újra" name="new_password_confirm">
                    </label>
                    <div class="error">
                        <?php
                        if (in_array("passwords_not_equal", $errors)) {
                            echo "<b>A két jelszó nem egyezik. Kérem próbálja újra!</b>";
                        }
                        ?>
                    </div>
                </div>

                <input type="submit" value="Jelszó módosítása">
            </form>
        </div>
    </div>
</main>

<?php include "views/components/footer.php"; ?>