<?php

class PurchaseDAO {
    private PDO $db;
    private string $tableName = "purchase";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get all Games purchased by the User.
     * @param string $email
     * @return array|null
     */
    public function getUserGames(string $email): ?array {
        $sql = "SELECT g.* FROM games g 
                INNER JOIN $this->tableName p ON g.id = p.game_id 
                WHERE p.user_email = :user_email";
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

    /**
     * Activate a purchase.
     * @param Purchase $purchase
     * @return bool (returns if the action was successful)
     */
    public function addPurchase(Purchase $purchase): bool {
        $sql = "INSERT INTO $this->tableName (game_id, user_email) VALUES (:game_id, :user_email)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $purchase->getGameId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_email', $purchase->getUserEmail());
        return $stmt->execute();
    }

    /**
     * Check if the User owns the actual Game.
     * @param Purchase $purchase
     * @return bool (returns if the action was successful)
     */
    public function isUserOwnsTheGame(Purchase $purchase): bool {
        $sql = "SELECT COUNT(*) FROM $this->tableName WHERE game_id = :game_id AND user_email = :user_email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $purchase->getGameId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_email', $purchase->getUserEmail());
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}