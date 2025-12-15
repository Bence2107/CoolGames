<?php

    $pageTitle = "404-es hiba";
    $activePage = "";
?>

<?php include "views/components/header.php"; ?>

<main>
    <div class="inner_main">
        <div class="inner">
            <div class="empty_sign">
                <img src="/img/notFound/notFoundImage.png" alt="">
                <h1>Az oldal nem <b>található!</b></h1>
                <h3>Kérem térjen vissza a főoldalra!</a></h3>
                <div class="action">
                    <form action="/index" method="get">
                        <input type="submit" value="A Főoldalra">
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "views/components/footer.php"; ?>