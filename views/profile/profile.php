<?php

    $pageTitle = "Profil - ". htmlspecialchars($user->getUsername());
    $activePage = "profile";
?>

<?php include "views/components/header.php"; ?>
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

<?php include "views/components/footer.php"; ?>