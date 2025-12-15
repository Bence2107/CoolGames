<?php

    $pageTitle = "Profil szerkesztése - Adatok";
    $activePage = "profile";
?>

<?php include "views/components/header.php"; ?>
<main>
    <?php if (isset($_SESSION["successful"])): ?>
        <div class="successful">
            <b>Adatok módosítva!</b>
        </div>
        <?php unset($_SESSION["successful"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION["typeError"])): ?>
        <div class="failed">
            <b>Nem megfelelő formátum! A megengedett képformátumok: '.jpg', '.png', '.jpeg'</b>
        </div>
        <?php unset($_SESSION["typeError"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION["fileSizeError"])): ?>
        <div class="failed">
            <b>Túl nagy fájlméret! 3MB vagy annál kisebb lehet!</b>
        </div>
        <?php unset($_SESSION["fileSizeError"]); ?>
    <?php endif; ?>

    <div class="inner_main">
        <h1 id="cim">Profil módosítása</h1>
        <div class="inner">
            <div class="profile_buttons">
                <?php if ($user->getProfilePicture() != null): ?>
                    <img class="profile_pick_2"
                         src="data:image/png;base64,<?= base64_encode($user->getProfilePicture()) ?>" alt="">
                <?php else: ?>
                    <img class="profile_pick_2" src="/img/profile/profilePicture.png" alt="">
                <?php endif; ?>

                <form id="form_box" method="post" enctype="multipart/form-data" action="/profile/picture">
                    <h2>Profilkép módosítása</h2>
                    <input type="file" name="profile-pic"><br>
                    <button type="submit">Profilkép Feltöltése</button>
                </form>
            </div>

            <div id="form_box2">
                <h2>Adatok módosítása</h2>
                <form method="post" action="/profile/edit">
                    <div class="input_field">
                        <label for="surname">
                            <input type="text" value="<?= htmlspecialchars($user->getSurname()) ?>" id="surname" name="surname">
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
                            <input type="text" value="<?= htmlspecialchars($user->getFirstname()) ?>" id="first_name" name="first_name">
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
                            <input type="text" value="<?= htmlspecialchars($user->getUsername()) ?>" id="username" name="username">
                        </label>
                        <div class="error">
                            <?php
                            if (in_array("username_already_exists", $errors)) {
                                echo "<b>Ez a felhasználónév már létezik. Kérem válasszon másikat!</b>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="input_field">
                        <label for="birth_date">
                            <input type="date" value="<?= htmlspecialchars($user->getBirthdate()) ?>" id="birth_date" name="birth_date" >
                        </label>
                    </div>

                    <input type="submit" value="Módosít">
                </form>
            </div>

            <div class="profile_buttons">
                <button onclick="location.href='/profile/edit/password'">Jelszó módosítása</button>
                <button id="warning" onclick="location.href='/profile/delete'">Profil törlése</button>
            </div>
        </div>
    </div>
</main>

<?php include "views/components/footer.php"; ?>