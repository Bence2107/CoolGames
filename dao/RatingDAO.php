<?php

class RatingDAO {
    private PDO $db;
    private string $tableName = "ratings";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Publish Rating to a Game from User
     * @param Rating $rating
     * @return bool
     */
    public function addRating(Rating $rating): bool {
        $sql = "INSERT INTO $this->tableName (game_id, user_email, rating) 
                VALUES (:game_id, :user_email, :rating)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $rating->getGameId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_email', $rating->getUserEmail());
        $stmt->bindValue(':rating', $rating->getRating(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Check if User already rated a Game
     * @param Game $game
     * @param User $user
     * @return bool
     */
    public function hasUserRated(Game $game, User $user): bool {
        $sql = "SELECT COUNT(*) FROM $this->tableName WHERE game_id = :game_id AND user_email = :user_email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $game->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_email', $user->getEmail());
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Get Users rating, what published to a Game
     * @param Game $game
     * @param User $user
     * @return float|null
     */
    public function getUserRating(Game $game, User $user): ?float {
        $sql = "SELECT rating FROM $this->tableName WHERE game_id = :game_id AND user_email = :user_email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $game->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_email', $user->getEmail());
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (float)$result['rating'] : null;
    }

    /**
     * Get a Game rating stats
     * @param Game $game
     * @return array (returns count and total)
     */
    public function getRatingStats(Game $game): array {
        $sql = "SELECT COUNT(rating) as numberOf, SUM(rating) as total 
                FROM $this->tableName WHERE game_id = :game_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':game_id', $game->getId(), PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return [
            'count' => (int)$result['numberOf'],
            'total' => (float)($result['total'] ?? 0)
        ];
    }
}