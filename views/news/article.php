<?php

    $pageTitle =  "Hírek - " . htmlspecialchars($article->getTitle());
    $activePage = "games";
?>

<?php include "views/components/header.php"; ?>
<main>
    <div class="inner_main">
        <div class="inner">
            <img id="new_image" src="/img/assets/new_images/<?= $article->getId() ?>.jpg" alt=""/>
            <div class="content">
                <h1 id="new_title"><?= htmlspecialchars($article->getTitle()) ?></h1>
                <br>
                <p><?= nl2br(htmlspecialchars($article->getContent())) ?></p>
                <hr>
                <p><?= htmlspecialchars($article->getPublishDate()) ?></p>
            </div>
        </div>
    </div>
</main>

<?php include "views/components/footer.php"; ?>