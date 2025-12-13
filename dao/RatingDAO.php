<?php

class RatingDAO {
    private PDO $db;
    private string $tableName = "ertekel";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function addRating(Rating $rating): bool {
        $sql = "INSERT INTO $this->tableName (jatek_id, email, ertekeles) 
                VALUES (:jatek_id, :email, :ertekeles)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jatek_id', $rating->getJatekId(), PDO::PARAM_INT);
        $stmt->bindValue(':email', $rating->getEmail());
        $stmt->bindValue(':ertekeles', $rating->getErtekeles(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function hasUserRated(Game $game, User $user): bool {
        $sql = "SELECT COUNT(*) FROM $this->tableName WHERE jatek_id = :jatek_id AND email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jatek_id', $game->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getUserRating(Game $game, User $user): ?float {
        $sql = "SELECT ertekeles FROM $this->tableName WHERE jatek_id = :jatek_id AND email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jatek_id', $game->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (float)$result['ertekeles'] : null;
    }

    public function getRatingStats(Game $game): array {
        $sql = "SELECT COUNT(ertekeles) as darab, SUM(ertekeles) as osszesen 
                FROM $this->tableName WHERE jatek_id = :jatek_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jatek_id', $game->getId(), PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return [
            'count' => (int)$result['darab'],
            'total' => (float)($result['osszesen'] ?? 0)
        ];
    }
}