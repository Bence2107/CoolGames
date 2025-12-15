<?php

class BasketDAO {
    private PDO $db;
    private string $tableName = "basket";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get all Games, what is inside current User's Basket.
     * @param User $user
     * @return array|null (with Article's in it)
     */
    public function getUsersBasket(User $user): ?array
    {
        $sql = "SELECT g.* FROM games g
                INNER JOIN $this->tableName b ON g.id = b.game_id 
                WHERE b.user_email = :user_email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_email', $user->getEmail());
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
     * Add Game to User's basket.
     * @param Game $game
     * @param User $user
     * @return bool (returns if the action was successful)
     */
    public function addToBasket(Game $game, User $user): bool {
        $sql = "INSERT INTO $this->tableName (game_id, user_email) VALUES (:game_id, :user_email)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $game->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_email', $user->getEmail());
        return $stmt->execute();
    }

    /**
     * Remove Game from User's basket.
     * @param Game $game
     * @param User $user
     * @return bool (returns if the action was successful)
     */
    public function removeFromBasket(Game $game, User $user): bool {
        $sql = "DELETE FROM $this->tableName WHERE game_id = :game_id AND user_email = :user_email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $game->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_email', $user->getEmail());
        return $stmt->execute();
    }

    /**
     * Clear all Games from User's basket.
     * @param User $user
     * @return bool (returns if the action was successful)
     */
    public function clearBasket(User $user): bool {
        $sql = "DELETE FROM $this->tableName WHERE user_email = :user_email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_email', $user->getEmail());
        return $stmt->execute();
    }
}