<?php
$errors = [];
if(isset($_SESSION["errors"])){
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
    <title>Jelszó módosítása</title>
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
            <?php if($user->getProfilePicture() != null): ?>
                <li>
                    <a href="/profile"><img class="header_avatar" src="data:image/png;base64,<?= base64_encode($user->getProfilePicture()) ?>" alt="" id="active2"></a>
                    <p><?= $user->getCatCredit() ?>&#128008;</p>
                </li>
            <?php else: ?>
                <li>
                    <a href="/profile"><img src="/img/profile/profilePicture.png" alt="" id="active2" class="header_avatar"></a>
                    <p><?= $user->getCatCredit() ?>&#128008;</p>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
    <?php if (isset($_SESSION["successfull"])): ?>
        <div class="successfull">
            <b>Jelszó módosítva!</b>
        </div>
        <?php unset($_SESSION["successfull"]); ?>
    <?php endif; ?>

    <div class="inner_main">
        <div id="form_box">
            <h2>Jelszó módosítása</h2>
            <form method="post" action="/profile/edit/password">
                <div class="input_field">
                    <input type="password" placeholder="Jelenlegi Jelszó" name="old_passwd">
                    <div class="error">
                        <?php
                        if(in_array("wrong_passwd",$errors)){
                            echo "<b>Hibás jelszó! Kérem próbálja újra!</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="Új Jelszó" name="new_passwd">
                    <div class="error">
                        <?php
                        if(in_array("new_passwd_not_equal",$errors)){
                            echo "<b>A két jelszó nem egyezik. Kérem próbálja újra!</b>";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="Új Jelszó Újra" name="new_passwd_again">
                    <div class="error">
                        <?php
                        if(in_array("new_passwd_not_equal",$errors)){
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
<footer>
    <hr>
    <div>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">2024 PORT:3306&#169;</a>
    </div>
</footer>
</body>
</html>