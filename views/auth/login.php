<?php

    $pageTitle = "Bejelentkezés";
    $activePage = "profile";
?>

<?php include "views/components/header.php"; ?>

<main>
    <?php if (isset($_SESSION['login_failed'])): ?>
        <div class="failed">
            <b>Hibás email vagy jelszó!</b>
        </div>
        <?php unset($_SESSION['login_failed']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['registration_success'])): ?>
        <div class="successful">
            <b>Sikeres regisztráció!<br>Kérem jelentkezzen be!</b>
        </div>
        <?php unset($_SESSION['registration_success']); ?>
    <?php endif; ?>

    <div class="inner_main">
        <div id="form_box">
            <h2>Bejelentkezés</h2>
            <form method="post" action="/auth/login">
                <div class="input_field">
                    <label for="email">
                        <input type="text" placeholder="Email" id="email" name="email">
                    </label>
                </div>
                <div class="input_field">
                    <label for="password">
                        <input type="password" placeholder="Jelszó" id="password" name="password">
                    </label>
                </div>
                <input type="submit" value="Bejelentkezés">
            </form>
            <div id="register_link">
                <p>Ha még nem Regisztráltál, <a href="/auth/register">itt</a> megteheted!</p>
            </div>
        </div>
    </div>
</main>

<?php include "views/components/footer.php"; ?>