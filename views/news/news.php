<?php

    $pageTitle =  "Hírek";
    $activePage = "news";
?>

<?php include "views/components/header.php"; ?>
<main>
    <div class="inner_main">
        <div class="inner">
            <div class="news_container">
                <?php foreach ($articles as $article): ?>
                    <a href="/news/article?title=<?= urlencode($article->getTitle()) ?>">
                        <div class="news_item">
                            <div class="new_description">
                                <h1><?= htmlspecialchars($article->getTitle()) ?></h1>
                                <br>
                                <p><?= htmlspecialchars($article->getShortDesc()) ?></p>
                                <hr>
                                <p><?= htmlspecialchars($article->getPublishDate()) ?></p>
                            </div>
                            <img src="/img/assets/new_images/<?= $article->getId() ?>.jpg" alt=""/>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php include "views/components/footer.php"; ?>