<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="/img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title><?= htmlspecialchars($game->getTitle()) ?></title>
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
            if ($user && $user->getProfilePicture() != null): ?>
                <li>
                    <a href="/profile"><img class="header_avatar"
                                            src="data:image/png;base64,<?= base64_encode($user->getProfilePicture()) ?>"
                                            alt=""></a>
                    <p><?= $user->getCatCredit() ?>&#128008;</p>
                </li>
            <?php else: ?>
                <li>
                    <a href="/profile"><img src="/img/profile/profilePicture.png" alt="" class="header_avatar"></a>
                    <?php if ($user): ?>
                        <p><?= $user->getCatCredit() ?>&#128008;</p>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
    <div class="inner_main">
        <div class="inner">
            <h1 id="title"><?= htmlspecialchars($game->getTitle()) ?></h1>
            <div class="content" id="game">
                <img src="/img/assets/games/<?= $game->getId() ?>.jpg" alt=""/>
                <div>
                    <div id="rating_container">
                        <h1>Értékelés: <?= round($game->getRating(), 1) ?></h1>
                    </div>
                    <h3>Megjelenés:</h3>
                    <p><?= htmlspecialchars($game->getPublishDate()) ?></p>
                    <h3>Fejlesztő:</h3>
                    <p><?= htmlspecialchars($game->getDeveloper()) ?></p>
                    <h3>Kiadó:</h3>
                    <p><?= htmlspecialchars($game->getPublisher()) ?></p>
                    <h3>Műfaj:</h3>
                    <p><?= htmlspecialchars($game->getGenre()) ?></p>
                    <hr>
                    <h2>Rövid Leírás:</h2>
                    <p><?= nl2br(htmlspecialchars($game->getShortDescription())) ?></p>
                </div>
                <iframe class="video" src="<?= htmlspecialchars($game->getVideoLink()) ?>" allowfullscreen></iframe>
                <h2>A Játékról:</h2>
                <p><?= nl2br(htmlspecialchars($game->getLongDescription())) ?></p>
                <div>
                    <?php if ($canRate): ?>
                        <div id="gameTier">
                            <form method="post" action="/games/rate?id='<?= $game->getId() ?>'">
                                <h2>Játék értékelése:</h2>
                                <label>
                                    <input type="number" name="rating" min="0" max="10" onkeydown="return false">
                                </label>
                                <input type="submit" value="Küldés">
                            </form>
                        </div>
                    <?php endif; ?>

                    <div class="game_buy_sign">
                        <h4>A(z) <?= htmlspecialchars($game->getTitle()) ?> megvásárlása</h4>
                        <div id="price">
                            <p><?= $game->getPrice() ?></p> &#128008;
                            <div>
                                <form method="post" action="/basket/add">
                                    <input type="hidden" value="<?= $game->getId() ?>" name="game_id">
                                    <input type="submit" value="Kosárba">
                                </form>
                            </div>
                        </div>
                    </div>
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