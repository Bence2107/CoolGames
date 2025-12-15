<?php

    $pageTitle = "Profil törlése - ". htmlspecialchars($user->getUsername());
    $activePage = "profile";
?>

<?php include "views/components/header.php"; ?>
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

<?php include "views/components/footer.php"; ?>