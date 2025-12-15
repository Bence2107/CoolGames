<?php

class Purchase {
    private int $game_id;
    private string $user_email;

    public function __construct(int $jatekId, string $email) {
        $this->game_id = $jatekId;
        $this->user_email = $email;
    }

    public function getGameid(): int {
        return $this->game_id;
    }

    public function getUserEmail(): string {
        return $this->user_email;
    }
}