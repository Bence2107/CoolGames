<?php
    $pageTitle = 'Kosár';
    $activePage = 'basket';
?>

<?php include "views/components/header.php"; ?>
<main>
    <?php if (isset($_SESSION['notEnoughMoneyError'])): ?>
        <div class="failed">
            <b>Nincs elég macskakredit a vásárláshoz!</b>
        </div>
        <?php unset($_SESSION['notEnoughMoneyError']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['buySuccessful'])): ?>
        <div class="successful">
            <b>Sikeres vásárlás!</b>
        </div>
        <?php unset($_SESSION['buySuccessful']); ?>
    <?php endif; ?>

    <div class="inner_main">
        <div class="inner">
            <h1 id="title">Kosár</h1>
            <div class="checkOut">
                <?php if (empty($basketGames)): ?>
                    <div class="empty_sign">
                        <img src="/img/basket/trolley_cart_warning_icon.png" alt="">
                        <h1>A kosara <b>üres</b></h1>
                        <h3>Amennyiben szeretné megvásárolni a termékeit, kérem először helyezze a kosárba őket</h3>
                        <div class="action">
                            <form action="/games" method="get">
                                <input type="submit" value="Játékok vásárlása">
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <hr>
                    <?php foreach ($basketGames as $game): ?>
                        <div class="checkOut_item">
                            <img src="/img/assets/games/<?= $game->getId() ?>.jpg" alt=""/>
                            <a href="/games/game?name=<?= urlencode($game->getTitle()) ?>"><?= htmlspecialchars($game->getTitle()) ?></a>
                            <p><?= $game->getPrice() ?>&#128008;</p>
                            <form method="post" action="/basket/remove">
                                <input type="hidden" value="<?= $game->getId() ?>" name="game_id">
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

<?php include "views/components/footer.php"; ?>