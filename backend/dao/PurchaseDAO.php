<?php

class PurchaseDAO {
    private PDO $db;
    private string $tableName = "birtokol";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * @return Game[]
     */
    public function getUserGames(string $email): array {
        $sql = "SELECT j.* FROM jatek j 
                INNER JOIN $this->tableName b ON j.id = b.jatek_id 
                WHERE b.felh_email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
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
                $data['h_leiras'],
                $data['video_link'],
                $data['megjelenes_datum'],
                $data['ertekeles'],
                $data['eredeti_ertekeles'],
                $data['ar']
            );
        }
        return $games;
    }

    public function addPurchase(Purchase $purchase): bool {
        $sql = "INSERT INTO $this->tableName (jatek_id, felh_email) VALUES (:jatek_id, :email)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jatek_id', $purchase->getJatekId(), PDO::PARAM_INT);
        $stmt->bindValue(':email', $purchase->getEmail());
        return $stmt->execute();
    }

    public function userOwnsGame(Purchase $purchase): bool {
        $sql = "SELECT COUNT(*) FROM $this->tableName WHERE jatek_id = :jatek_id AND felh_email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jatek_id', $purchase->getJatekId(), PDO::PARAM_INT);
        $stmt->bindValue(':email', $purchase->getEmail());
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}