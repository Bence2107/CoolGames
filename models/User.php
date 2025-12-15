<?php

class User {
    private ?string $email;
    private ?string $username;
    private ?string $surname;
    private ?string $first_name;
    private ?string $password;
    private ?string $birth_date;
    private ?string $profile_picture;
    private int $cat_credit;

    public function __construct(
        ?string $email,
        ?string $username,
        ?string $surname,
        ?string $first_name,
        ?string $password,
        ?string $birth_date,
        ?string $profile_picture,
        ?int $cat_credit
    ) {
        $this->email = $email;
        $this->username = $username;
        $this->surname = $surname;
        $this->first_name = $first_name;
        $this->password = $password;
        $this->birth_date = $birth_date;
        $this->profile_picture = $profile_picture;
        $this->cat_credit = $cat_credit;
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
        return $this->first_name;
    }

    public function setFirstname(?string $first_name): void {
        $this->first_name = $first_name;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function getBirthdate(): ?string {
        return $this->birth_date;
    }

    public function setBirthdate(?string $birth_date): void {
        try {
            $dateObj = new DateTime($birth_date);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        $this->birth_date = $dateObj->format('Y-m-d');
    }

    public function getProfilePicture(): ?string {
        return $this->profile_picture;
    }

    public function setProfilePicture(?string $profile_picture): void {
        $this->profile_picture = $profile_picture;
    }

    public function getCatCredit(): int {
        return $this->cat_credit;
    }

    public function setCatCredit(int $cat_credit): void {
        $this->cat_credit = $cat_credit;
    }
}
