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
    <title><?= $pageTitle ?? 'CoolGames' ?></title>
</head>
<body>
<header>
    <img src="/img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="/index" <?= ($activePage ?? '') === "index" ? 'id="active"' : '' ?>>Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="/news" <?= ($activePage ?? '') === "news" ? 'id="active"' : '' ?>>Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="/games" <?= ($activePage ?? '') === "games" ? 'id="active"' : '' ?>>Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="/basket" <?= ($activePage ?? '') === "basket" ? 'id="active"' : '' ?>>Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
            <?php
            $user = SessionHelper::getCurrentUser();
            if ($user):
                if ($user->getProfilePicture() != null): ?>
                    <li>
                        <a href="/profile"><img class="header_avatar"
                                                src="data:image/png;base64,<?= base64_encode($user->getProfilePicture()) ?>"
                                                alt="" <?= ($activePage ?? '') === "profile" ? 'id="active_profile_frame"' : '' ?>></a>
                        <p><?= $user->getCatCredit() ?>&#128008;</p>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/profile"><img src="/img/profile/profilePicture.png" alt="" class="header_avatar" <?= ($activePage ?? '') === 'profile' ? 'id="active_profile_frame"' : '' ?>></a>
                        <p><?= $user->getCatCredit() ?>&#128008;</p>
                    </li>
                <?php endif;
            else: ?>
                <li class="dropdown">
                    <a href="/profile">Fiók <i class="fa-solid fa-user">&nbsp;</i></a>
                    <div class="dropdown_content">
                        <a href="/auth/login">Bejelentkezés</a><br>
                        <a href="/auth/register">Regisztráció</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>