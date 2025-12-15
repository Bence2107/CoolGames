<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="/img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Profil törlése</title>
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
            <?php if ($user->getProfilePicture() != null): ?>
                <li>
                    <a href="/profile"><img class="header_avatar"
                                            src="data:image/png;base64,<?= base64_encode($user->getProfilePicture()) ?>"
                                            alt="" id="active_profile_frame"></a>
                    <p><?= $user->getCatCredit() ?>&#128008;</p>
                </li>
            <?php else: ?>
                <li>
                    <a href="/profile"><img src="/img/profile/profilePicture.png" alt="" id="active_profile_frame"
                                            class="header_avatar"></a>
                    <p><?= $user->getCatCredit() ?>&#128008;</p>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
    <div class="inner_main">
        <div class="inner">
            <div class="window">
                <p>Biztosan törölni szeretné, ezt a profilt, és minden hozzátartozó információt?:</p>
                <b><?= htmlspecialchars($user->getUsername()) ?></b><br>
                <div class="profile_buttons" id="windows">
                    <form method="post" action="/profile/delete">
                        <input type="submit" id="warning" value="Igen">
                    </form>
                    <button id="window_no" onclick="location.href='/profile/edit'">Nem</button>
                </div>
            </div>
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