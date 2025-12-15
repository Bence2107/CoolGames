<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="/img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Profil</title>
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
            <div class="profile_container">
                <div class="profile_pick_container">
                    <div class="profile_buttons">
                        <?php if ($user->getProfilePicture() != null): ?>
                            <img class="profile_pick"
                                 src="data:image/jpeg;base64,<?= base64_encode($user->getProfilePicture()) ?>" alt="">
                        <?php else: ?>
                            <img src="/img/profile/profilePicture.png" alt="" class="profile_pick">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="profile_data_container">
                    <h1>Fiók</h1>
                    <div class="profile_data">
                        <b>Email:</b>
                        <p><?= htmlspecialchars($user->getEmail()) ?></p>
                    </div>
                    <div class="profile_data">
                        <b>Felhasználónév:</b>
                        <p><?= htmlspecialchars($user->getUsername()) ?></p>
                    </div>
                    <div class="profile_data">
                        <b>Név:</b>
                        <p><?= htmlspecialchars($user->getSurname()) ?> <?= htmlspecialchars($user->getFirstname()) ?></p>
                    </div>
                    <div class="profile_data">
                        <b>Születési Dátum:</b>
                        <p><?= htmlspecialchars($user->getBirthdate()) ?></p>
                    </div>
                    <div class="profile_data">
                        <b>Aktuális MacskaKredit:</b>
                        <p><?= $user->getCatCredit() ?>&#128008;</p>
                    </div>
                    <hr>
                    <div class="profile_buttons">
                        <button onclick="location.href='/profile/edit'">Profil szerkesztése</button>
                        <form method="post" id="logOut" action="/auth/logout">
                            <input id="warning" type="submit" value="Kijelentkezés">
                        </form>
                    </div>
                </div>
            </div>
            <h1 id="title">Játékaim:</h1>
            <div class="games_container">
                <?php if (empty($ownedGames)): ?>
                    <div class="empty_sign">
                        <h3>Ön még egy játéknak sem a tulajdonosa. Hogy birtokoljon, látogasson el a Játékok
                            Weboldalra:</h3>
                        <div class="action">
                            <form action="/games">
                                <input type="submit" value="Játékok vásárlása">
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($ownedGames as $game): ?>
                        <div class="game">
                            <a href="/games/game?name=<?= urlencode($game->getTitle()) ?>">
                                <img src="/img/assets/games/<?= $game->getId() ?>.jpg" alt=""/>
                            </a>
                            <h3><?= htmlspecialchars($game->getTitle()) ?></h3>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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