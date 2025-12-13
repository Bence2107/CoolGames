<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="/img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Játékok</title>
</head>
<body>
<header>
    <img src="/img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="/index">Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="/news">Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="/games" id="active">Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="/basket">Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
            <?php
                $user = SessionHelper::getCurrentUser();
                if($user && $user->getProfilepicture() != null): ?>
            <li>
                <a href="/profile"><img class="header_avatar" src="data:image/jpeg;base64,<?= base64_encode($user->getProfilepicture()) ?>" alt=""></a>
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
        </ul>
    </nav>
</header>
<main>
    <?php if (isset($_SESSION['addToBasketSuccessfull'])): ?>
    <div class="successfull">
        <b>Játék kosárhoz adva!</b>
    </div>
        <?php unset($_SESSION['addToBasketSuccessfull']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['ratingSuccess'])): ?>
        <div class="successfull">
            <b>Játék értékelve! 5 pont hozzáadva az egyenleghez!</b>
        </div>
        <?php unset($_SESSION['ratingSuccess']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['alreadyInBasket'])): ?>
        <div class="failed">
            <b>A Játék már a kosárhoz van adva!</b>
        </div>
        <?php unset($_SESSION['alreadyInBasket']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['ownedGame'])): ?>
        <div class="failed">
            <b>Ezt Játékot már birtokolja!</b>
        </div>
        <?php unset($_SESSION['ownedGame']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['alreadyRated'])): ?>
        <div class="failed">
            <b>Ezt Játékot már értékelte!</b>
        </div>
        <?php unset($_SESSION['alreadyRated']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['notOwnedRate'])): ?>
        <div class="failed">
            <b>Ahhoz hogy értékelni tudja a játékot, először meg kell vásárolnia!</b>
        </div>
        <?php unset($_SESSION['notOwnedRate']); ?>
    <?php endif; ?>

    <div class="inner_main">
        <div class="inner">
            <h1 id="title">Top 3 Legjobb Játékunk:</h1>
            <div class="games_container">
                <?php foreach($topGames as $game): ?>
                    <div class="game">
                        <a href="/games/game?name=<?= urlencode($game->getNev()) ?>">
                            <img src="/img/assets/games/<?= $game->getId() ?>.jpg" alt="">
                        </a>
                        <h3><?= htmlspecialchars($game->getNev()) ?>
                            <br>
                            <span><?= $game->getAr() ?>&#128008;</span>
                        </h3>
                    </div>
                <?php endforeach; ?>
            </div>

            <h1 id="title2">Összes Játékunk:</h1>
            <div class="games_container">
                <?php foreach($games as $game): ?>
                    <div class="game">
                        <a href="/games/game?name=<?= urlencode($game->getNev()) ?>">
                            <img src="/img/assets/games/<?= $game->getId() ?>.jpg" alt="">
                        </a>
                        <h3><?= htmlspecialchars($game->getNev()) ?>
                            <br>
                            <span><?= $game->getAr() ?>&#128008;</span>
                        </h3>
                    </div>
                <?php endforeach; ?>
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