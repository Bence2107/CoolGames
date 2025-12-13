<?php

class ArticleService {
    private ArticleDAO $articleDAO;
    public function __construct(ArticleDAO $articleDAO) {
        $this->articleDAO = $articleDAO;
    }

    public function getArticles(): array {
        return $this->articleDAO->getArticles();
    }
    public function getArticleByTitle(string $title) : ?Article{
        return $this->articleDAO->getArticleByTitle($title);
    }
}