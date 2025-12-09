<?php

class Rating
{
    private int $jatekId;
    private string $email;
    private int $ertekeles;

    public function __construct(int $jatekId, string $email, int $ertekeles)
    {
        $this->jatekId = $jatekId;
        $this->email = $email;
        $this->ertekeles = $ertekeles;
    }

    public function getJatekId(): int
    {
        return $this->jatekId;
    }

    public function setJatekId(int $jatekId): void
    {
        $this->jatekId = $jatekId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getErtekeles(): int
    {
        return $this->ertekeles;
    }

    public function setErtekeles(int $ertekeles): void
    {
        $this->ertekeles = $ertekeles;
    }




}