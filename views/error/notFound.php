<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="/img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>CoolGames - Főoldal</title>
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
            <?php if(!isset($_SESSION["email"])): ?>
                <li class="dropdown">
                    <a href="/profile">Fiók <i class="fa-solid fa-user">&nbsp;</i></a>
                    <div class="dropdown_content">
                        <a href="/auth/login">Bejelentkezés</a><br>
                        <a href="/auth/register">Regisztráció</a>
                    </div>
                </li>
            <?php else:
                $user = SessionHelper::getCurrentUser();
                if($user && $user->getProfilepicture() != null): ?>
                    <li>
                        <a href="/profile"><img class="header_avatar" src="data:image/png;base64,<?= base64_encode($user->getProfilepicture()) ?>" alt=""></a>
                        <p><?= $user->getCatcredit() ?>&#128008;</p>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/profile"><img src="/img/profile/profilePicture.png" alt="" class="header_avatar"></a>
                        <?php if($user): ?>
                            <p><?= $user->getCatcredit() ?>&#128008;</p>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
    <div class="inner_main">
        <div class="inner">
            <div class="empty_sign">
                <img src="/img/notFound/notFoundImage.png" alt="">
                <h1>Az oldal nem <b>található!</b></h1>
                <h3>Kérem térjen vissza a főoldalra!</a></h3>
                <div class="action">
                    <form action="/index" method="get">
                        <input type="submit" value="A Főoldalra">
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
</body>
</html>