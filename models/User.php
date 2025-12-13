<?php

class User {
    private ?string $email;
    private ?string $username;
    private ?string $surname;
    private ?string $firstname;
    private ?string $password;
    private ?string $birthdate;
    private ?string $profilepicture;
    private int $catcredit;

    public function __construct(
        ?string $email,
        ?string $username,
        ?string $veznev,
        ?string $kernev,
        ?string $jelszo,
        ?string $szul_datum,
        ?string $profilkep,
        ?int $macskakredit
    ) {
        $this->email = $email;
        $this->username = $username;
        $this->surname = $veznev;
        $this->firstname = $kernev;
        $this->password = $jelszo;
        $this->birthdate = $szul_datum;
        $this->profilepicture = $profilkep;
        $this->catcredit = $macskakredit;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $username): void {
        $this->username = $username;
    }

    public function getSurname(): ?string {
        return $this->surname;
    }

    public function setSurname(?string $surname): void {
        $this->surname = $surname;
    }

    public function getFirstname(): ?string {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void {
        $this->firstname = $firstname;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function getBirthdate(): ?string {
        return $this->birthdate;
    }

    public function setBirthdate(?string $birthdate): void {
        try {
            $dateObj = new DateTime($birthdate);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        $this->birthdate = $dateObj->format('Y-m-d');
    }

    public function getProfilepicture(): ?string {
        return $this->profilepicture;
    }

    public function setProfilepicture(?string $profilepicture): void {
        $this->profilepicture = $profilepicture;
    }

    public function getCatcredit(): int {
        return $this->catcredit;
    }

    public function setCatcredit(int $catcredit): void {
        $this->catcredit = $catcredit;
    }
}
