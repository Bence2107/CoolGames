<?php

class GameDAO {
    private PDO $db;
    private string $tableName = "games";

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

    public function getGames() : array
    {
        $sql = "SELECT * FROM $this->tableName ORDER BY title";
        return $this->gamesQuery($sql);
    }

    public function getTopThreeGames() : array {
        $sql = "SELECT * FROM $this->tableName ORDER BY rating DESC LIMIT 3";
        return $this->gamesQuery($sql);
    }

    public function getGameByName(string $name) : ?Game {
        $sql = "SELECT * FROM $this->tableName WHERE title = :title";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':title', $name);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data) {
            return new Game(
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
        return null;
    }

    public function updateGameRating(Game $game, float $newRating): bool {
        $sql = "UPDATE $this->tableName SET rating = :rating WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':rating', $newRating);
        $stmt->bindValue(':id', $game->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }
}