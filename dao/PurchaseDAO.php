<?php

class PurchaseDAO {
    private PDO $db;
    private string $tableName = "purchase";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * @return Game[]
     */
    public function getUserGames(string $email): array {
        $sql = "SELECT j.* FROM games j 
                INNER JOIN $this->tableName b ON j.id = b.game_id 
                WHERE b.user_email = :user_email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_email', $email);
        $stmt->execute();

        $games = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $games[] = new Game(
                $data['id'],
                $data['title'],
                $data['developer'],
                $data['publisher'],
                $data['genre'],
                $data['short_description'],
                $data['long_description'],
                $data['video_link'],
                $data['publish_date'],
                $data['rating'],
                $data['original_rating'],
                $data['price'],
            );
        }
        return $games;
    }

    public function addPurchase(Purchase $purchase): bool {
        $sql = "INSERT INTO $this->tableName (game_id, user_email) VALUES (:game_id, :user_email)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $purchase->getGameId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_email', $purchase->getUserEmail());
        return $stmt->execute();
    }

    public function userOwnsGame(Purchase $purchase): bool {
        $sql = "SELECT COUNT(*) FROM $this->tableName WHERE game_id = :game_id AND user_email = :user_email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $purchase->getGameId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_email', $purchase->getUserEmail());
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}