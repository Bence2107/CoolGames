<?php

class ArticleController {
    private ArticleService $articleService;
    private View $view;

    public function __construct(ArticleService $articleService, View $view) {
        $this->articleService = $articleService;
        $this->view = $view;
    }

    public function showNews(): void {
        $articles = $this->articleService->getArticles();

        try {
            $this->view->render('news', [
                'articles' => $articles
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function showArticle(): void {
        if (!isset($_GET['cim'])) {
            header("Location: /news");
            exit();
        }

        $title = $_GET['cim'];
        $article = $this->articleService->getArticleByTitle($title);

        if ($article === null) {
            header("HTTP/1.0 404 Not Found");
            echo "<h1>Article Not Found</h1>";
            exit();
        }

        try {
            $this->view->render('new', [
                'article' => $article
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}