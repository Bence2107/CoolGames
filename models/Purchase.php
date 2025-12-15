<?php

class Purchase {
    private int $game_id;
    private string $user_email;

    public function __construct(int $game_id, string $email)
    {
        $this->game_id = $game_id;
        $this->user_email = $email;
    }

    public function getGameId(): int
    {
        return $this->game_id;
    }

    public function getUserEmail(): string
    {
        return $this->user_email;
    }
}