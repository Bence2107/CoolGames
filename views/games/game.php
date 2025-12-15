<?php

    $pageTitle = "Játékok - " . htmlspecialchars($game->getTitle());
    $activePage = "games";
?>

<?php include "views/components/header.php"; ?>

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

<?php include "views/components/footer.php"; ?>