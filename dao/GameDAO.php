<?php

class GameDAO {
    private PDO $db;
    private string $tableName = "jatek";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function gamesQuery(string $sql): array {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $games = [];

        foreach ($rows as $data) {
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
                $data['ar'],
            );
        }
        return $games;
    }

    public function getGames() : array
    {
        $sql = "SELECT * FROM $this->tableName ORDER BY nev";
        return $this->gamesQuery($sql);
    }

    public function getTopThreeGames() : array {
        $sql = "SELECT * FROM $this->tableName ORDER BY ertekeles DESC LIMIT 3";
        return $this->gamesQuery($sql);
    }

    public function getGameByName(string $name) : ?Game {
        $sql = "SELECT * FROM $this->tableName WHERE nev = :name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data) {
            return new Game(
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
                $data['ar'],
            );
        }
        return null;
    }

    public function updateGameRating(Game $game, float $newRating): bool {
        $sql = "UPDATE $this->tableName SET ertekeles = :rating WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':rating', $newRating);
        $stmt->bindValue(':id', $game->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }
}