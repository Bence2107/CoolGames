<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="/img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Kosár</title>
</head>
<body>
<header>
    <img src="/img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="/index">Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="/news">Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="/games">Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="/basket" id="active">Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
            <?php
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
        </ul>
    </nav>
</header>
<main>
    <?php if (isset($_SESSION['notEnoughMoneyError'])): ?>
        <div class="failed">
            <b>Nincs elég pénze a vásárláshoz!</b>
        </div>
        <?php unset($_SESSION['notEnoughMoneyError']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['buySuccessfull'])): ?>
        <div class="successfull">
            <b>Sikeres vásárlás!</b>
        </div>
        <?php unset($_SESSION['buySuccessfull']); ?>
    <?php endif; ?>

    <div class="inner_main">
        <div class="inner">
            <h1 id="title">Kosár</h1>
            <div class="checkOut">
                <?php if(empty($basketGames)): ?>
                    <div class="empty_sign">
                        <img src="/img/basket/trolley_cart_warning_icon.png" alt="">
                        <h1>A kosara <b>üres</b></h1>
                        <h3>Amennyiben szeretné megvásárolni a termékeit, kérem először helyezze a kosárba őket</h3>
                        <div class="action">
                            <form action="/games">
                                <input type="submit" value="Játékok vásárlása">
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <hr>
                    <?php foreach($basketGames as $game): ?>
                        <div class="checkOut_item">
                            <img src="/img/assets/games/<?= $game->getId() ?>.jpg" alt=""/>
                            <a href="/games/game?name=<?= urlencode($game->getNev()) ?>"><?= htmlspecialchars($game->getNev()) ?></a>
                            <p><?= $game->getAr() ?>&#128008;</p>
                            <form method="post" action="/basket/remove">
                                <input type="hidden" value="<?= $game->getId() ?>" name="jatekID">
                                <input type="submit" value="Törlés">
                            </form>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="action">
                        <h1>Összesen:</h1>
                        <p><?= $totalPrice ?>&#128008;</p>
                        <form method="post" action="/basket/purchase">
                            <input type="submit" value="Vásárlás">
                        </form>
                        <br>
                        <p>Vásárlásért járó pont: <?= $reward ?>&#128008;</p>
                        <p>Fizetendő: <?= $finalPrice ?>&#128008;</p>
                    </div>
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