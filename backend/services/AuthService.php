<?php

class AuthService {
    private UserDAO $userDAO;

    public function __construct(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    public function getUserByEmail(string $email) : ?User{
        return $this->userDAO->getByEmail($email);
    }

    public function validateRegistration(array $data): array{
        $errors = [];

        $email = $data["email"];
        $veznev = $data["veznev"];
        $kernev = $data["kernev"];
        $username = $data["username"];
        $password = $data["password"];
        $passwordagain = $data["passwdagain"];
        $szul_datum = $data["szul_datum"];

        /*Ellenőrzések*/
        //Emptys

        if(empty(trim($email))){
            $errors[] = "empty_email";
        }
        if(empty(trim($veznev))){
            $errors[] = "empty_veznev";
        }
        if(empty(trim($kernev))){
            $errors[] = "empty_kernev";
        }
        if(empty(trim($username))){
            $errors[] = "empty_username";
        }
        if(empty(trim($password))){
            $errors[] = "empty_password";
        }
        if(empty(trim($passwordagain))){
            $errors[] = "empty_passwordagain";
        }

        //Nev
        if(trim(strlen($veznev)>45)){
            $errors[] = "long_veznev";
        }
        if(trim(strlen($kernev)>45)){
            $errors[] = "long_kernev";
        }
        if(trim(strlen($username)>50)){
            $errors[] = "long_username";
        }
        $isUserWithNameExits = $this->userDAO->getByUsername($username);
        if($isUserWithNameExits)
        {
            $errors[] = "username_contains";
        }


        //Jelszo
        if($password !== "" && strlen($password) < 7)
            $errors[] = "short_password";
        if($password!== "" && strlen($password) > 7 && (!preg_match("/[a-zA-Z]/",$password) || !preg_match("/[0-9]/",$password)))
            $errors[] = "wrong_character";
        if($passwordagain!="" && $password!=$passwordagain){
            $errors[] = "passwords_not_match";
        }


        //Email
        if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "helytelen_email";
        }
        $isUserWithEmailExits = $this->userDAO->getByEmail($email);
        if($isUserWithEmailExits) {
            $errors[] = "email_contains";
        }

        //Datum
        $szul_datum2 = explode("-",$szul_datum);
        if($szul_datum2[0]<1930 || $szul_datum2[0]>2024){
            $errors[] = "invalid_year";
        }

        return $errors;

    }

    public function login(string $email, string $password): ?User {
        $user = $this->userDAO->getByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }
        return null;
    }


    public function registerUser(array $data): bool {
        $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);

        $user = new User(
            $data["email"],
            $data["username"],
            $data["veznev"],
            $data["kernev"],
            $hashedPassword,
            $data["szul_datum"],
            null,
            0
        );

        return $this->userDAO->create($user);
    }

    public function changePassword(string $email, string $oldPassword, string $newPassword, string $newPasswordAgain): array {
        $errors = [];
        $user = $this->userDAO->getByEmail($email);

        if (!$user) {
            $errors[] = "user_not_found";
        }

        if ($user && !password_verify($oldPassword, $user->getPassword())) {
            $errors[] = "wrong_passwd";
        }
        if ($newPassword !== $newPasswordAgain) {
            $errors[] = "new_passwd_not_equal";
        }

        if (empty($errors)) {
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $user->setPassword($passwordHash);
            $this->userDAO->updatePassword($user);
        }

        return $errors;
    }

    public function deleteAccount(string $email): bool {
        return $this->userDAO->deleteByEmail($email);
    }
}
