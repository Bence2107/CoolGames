<?php

class BasketItem
{
    private int $jatekId;
    private string $email;

    public function __construct(int $jatekId, string $email)
    {
        $this->jatekId = $jatekId;
        $this->email = $email;
    }

    public function getJatekId(): int
    {
        return $this->jatekId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}