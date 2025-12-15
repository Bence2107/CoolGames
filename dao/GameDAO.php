<?php

class GameDAO {
    private PDO $db;
    private string $tableName = "games";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Execute Game query
     * @param string $sql
     * @return array|null (returns Game's in array)
     */
    public function gamesQuery(string $sql): ?array {
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

    /**
     * Get All Games.
     * @return array|null (returns Game's in array)
     */
    public function getGames() : ?array
    {
        $sql = "SELECT * FROM $this->tableName ORDER BY title";
        return $this->gamesQuery($sql);
    }


    /**
     * Get Top 3 Games by rating.
     * @return array|null (returns Game's in array)
     */
    public function getTopThreeGames() : ?array {
        $sql = "SELECT * FROM $this->tableName ORDER BY rating DESC LIMIT 3";
        return $this->gamesQuery($sql);
    }

    /**
     * Get Game by its title, if its exits.
     * @param string $title
     * @return ?Game
     */
    public function getGameByName(string $title) : ?Game {
        $sql = "SELECT * FROM $this->tableName WHERE title = :title";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':title', $title);
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

    /**
     * Update Game's rating after a User rates.
     * @param Game $game
     * @param float $newRating
     *
     * @return bool (returns if the action was successful)
     */
    public function updateGameRating(Game $game, float $newRating): bool {
        $sql = "UPDATE $this->tableName SET rating = :rating WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':rating', $newRating);
        $stmt->bindValue(':id', $game->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }
}