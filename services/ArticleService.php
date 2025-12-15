<?php

class ArticleService {
    private ArticleDAO $articleDAO;

    public function __construct(ArticleDAO $articleDAO) {
        $this->articleDAO = $articleDAO;
    }

    /**
     * Return all Articles from Database.
     * @return array
     */
    public function getArticles(): array {
        return $this->articleDAO->getArticles();
    }

    /**
     * Returns article by title.
     * @param string $title
     * @return Article|null
     */
    public function getArticleByTitle(string $title): ?Article {
        return $this->articleDAO->getArticleByTitle($title);
    }
}