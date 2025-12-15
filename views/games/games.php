<?php

    $pageTitle =  "Játékok";
    $activePage = "games";
?>

<?php include "views/components/header.php"; ?>

<main>
    <?php if (isset($_SESSION['addToBasketSuccessful'])): ?>
        <div class="successful">
            <b>Játék kosárhoz adva!</b>
        </div>
        <?php unset($_SESSION['addToBasketSuccessful']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['ratingSuccess'])): ?>
        <div class="successful">
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
                <?php foreach ($topGames as $game): ?>
                    <div class="game">
                        <a href="/games/game?name=<?= urlencode($game->getTitle()) ?>">
                            <img src="/img/assets/games/<?= $game->getId() ?>.jpg" alt="">
                        </a>
                        <h3><?= htmlspecialchars($game->getTitle()) ?>
                            <br>
                            <span><?= $game->getPrice() ?>&#128008;</span>
                        </h3>
                    </div>
                <?php endforeach; ?>
            </div>

            <h1 id="title2">Összes Játékunk:</h1>
            <div class="games_container">
                <?php foreach ($games as $game): ?>
                    <div class="game">
                        <a href="/games/game?name=<?= urlencode($game->getTitle()) ?>">
                            <img src="/img/assets/games/<?= $game->getId() ?>.jpg" alt="">
                        </a>
                        <h3><?= htmlspecialchars($game->getTitle()) ?>
                            <br>
                            <span><?= $game->getPrice() ?>&#128008;</span>
                        </h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php include "views/components/footer.php"; ?>