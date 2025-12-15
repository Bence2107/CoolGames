<?php

class Rating
{
    private int $game_id;
    private string $user_email;
    private int $rating;

    public function __construct(int $gameID, string $email, int $rating)
    {
        $this->game_id = $gameID;
        $this->user_email = $email;
        $this->rating = $rating;
    }

    public function getGameid(): int
    {
        return $this->game_id;
    }

    public function setGameid(int $game_id): void
    {
        $this->game_id = $game_id;
    }

    public function getUserEmail(): string
    {
        return $this->user_email;
    }

    public function setUserEmail(string $user_email): void
    {
        $this->user_email = $user_email;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }
}