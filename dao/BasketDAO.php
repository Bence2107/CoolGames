<?php

class BasketDAO {
    private PDO $db;
    private string $tableName = "kosar";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getUsersBasket(User $user): array {
        $sql = "SELECT j.* FROM jatek j 
                INNER JOIN $this->tableName k ON j.id = k.jatek_id 
                WHERE k.email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->execute();

        $games = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $games[] = new Game(
                $data['id'],
                $data['nev'],
                $data['fejleszto'],
                $data['kiado'],
                $data['mufaj'],
                $data['r_leiras'],
                $data['h_lerias'],
                $data['video_link'],
                $data['megjelenes_datum'],
                $data['ertekeles'],
                $data['eredeti_ertekeles'],
                $data['ar']
            );
        }
        return $games;
    }

    public function addToBasket(Game $game, User $user): bool {
        $sql = "INSERT INTO $this->tableName (jatek_id, email) VALUES (:jatek_id, :email)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jatek_id', $game->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':email', $user->getEmail());
        return $stmt->execute();
    }

    public function removeFromBasket(Game $game, User $user): bool {
        $sql = "DELETE FROM $this->tableName WHERE jatek_id = :jatek_id AND email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jatek_id', $game->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':email', $user->getEmail());
        return $stmt->execute();
    }

    public function clearBasket(User $user): bool {
        $sql = "DELETE FROM $this->tableName WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail());
        return $stmt->execute();
    }
}