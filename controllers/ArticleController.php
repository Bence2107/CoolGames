<?php

class ArticleController {
    private ArticleService $articleService;
    private View $view;

    public function __construct(ArticleService $articleService, View $view) {
        $this->articleService = $articleService;
        $this->view = $view;
    }

    public function showNews(): void {
        $_SESSION["news"] = true;

        $articles = $this->articleService->getArticles();

        try {
            $this->view->render('news/news', [
                'articles' => $articles
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function showArticle(): void {
        $_SESSION["news"] = true;

        if (!isset($_GET['title'])) {
            header("Location: /news");
            exit();
        }

        $title = $_GET['title'];
        $article = $this->articleService->getArticleByTitle($title);

        if ($article === null) {
            header("HTTP/1.0 404 Not Found");
            echo "<h1>Article Not Found</h1>";
            exit();
        }

        try {
            $this->view->render('news/article', [
                'article' => $article
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}