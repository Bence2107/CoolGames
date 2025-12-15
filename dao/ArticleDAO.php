<?php

class ArticleDAO {
    private PDO $db;

    private string $tableName = "news";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get All Articles.
     * @return array (with Article's in it)
     */
    public function getArticles(): array {
        $sql = "SELECT * FROM $this->tableName ORDER BY publish_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles = [];

        foreach ($rows as $data) {
            $articles[] = new Article(
                $data['id'],
                $data['title'],
                $data['short_description'],
                $data['content'],
                $data['publish_date']
            );
        }
        return $articles;
    }

    /**
     * Get Article by Title if exits.
     *
     * @param string $title
     *
     * @return ?Article
     */

    public function getArticleByTitle(string $title): ?Article {
        $sql = "SELECT * FROM $this->tableName WHERE title = :title";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data) {
            return new Article(
                $data['id'],
                $data['title'],
                $data['short_description'],
                $data['content'],
                $data['publish_date']
            );
        }

        return null;
    }
}