<?php

class ArticleDAO {
    private PDO $db;

    private string $tableName = "hir";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getArticles(): array {
        $sql = "SELECT * FROM $this->tableName ORDER BY datum";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles = [];

        foreach ($rows as $data) {
            $articles[] = new Article(
                $data['id'],
                $data['cim'],
                $data['rovid_leiras'],
                $data['tartalom'],
                $data['datum']
            );
        }
        return $articles;
    }

    public function getArticleByTitle(string $title): ?Article {
        $sql = "SELECT * FROM $this->tableName WHERE cim = :title";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data) {
            return new Article(
                $data['id'],
                $data['cim'],
                $data['rovid_leiras'],
                $data['tartalom'],
                $data['datum']
            );
        }

        return null;
    }
}