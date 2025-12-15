<?php

class AuthService {
    private UserDAO $userDAO;

    public function __construct(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    /**
     * Returns User by email.
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email) : ?User{
        return $this->userDAO->getByEmail($email);
    }

    /**
     * Validates Registration form.
     * @param array $data (form's data)
     * @return array (return errors)
     */
    public function validateRegistration(array $data): array{
        $errors = [];

        $email = $data["email"];
        $username = $data["username"];
        $surname = $data["surname"];
        $first_name = $data["first_name"];
        $password = $data["password"];
        $password_again = $data["password_again"];
        $birth_date = $data["birth_date"];

        //Checks:
        //Is empty:
        if(empty(trim($email))){
            $errors[] = "empty_email";
        }
        if(empty(trim($username))){
            $errors[] = "empty_username";
        }
        if(empty(trim($surname))){
            $errors[] = "empty_surname";
        }
        if(empty(trim($first_name))){
            $errors[] = "empty_first_name";
        }
        if(empty(trim($password))){
            $errors[] = "empty_password";
        }
        if(empty(trim($password_again))){
            $errors[] = "empty_password_again";
        }

        if (empty(trim($birth_date))) {
            $errors[] = "empty_birth_date";
        }

        //Email
        if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "invalid_email";
        }
        $isUserWithEmailExits = $this->userDAO->getByEmail($email);
        if($isUserWithEmailExits) {
            $errors[] = "email_already_exists";
        }

        //Names
        if(trim(strlen($surname)>45)){
            $errors[] = "long_surname";
        }
        if(trim(strlen($first_name)>45)){
            $errors[] = "long_first_name";
        }
        if(trim(strlen($username)>50)){
            $errors[] = "long_username";
        }
        $isUserWithNameExits = $this->userDAO->getByUsername($username);
        if($isUserWithNameExits)
        {
            $errors[] = "username_already_exists";
        }

        //Password
        if($password !== "" && strlen($password) < 7)
            $errors[] = "short_password";
        if($password!== "" && strlen($password) > 7 && (!preg_match("/[a-zA-Z]/",$password) || !preg_match("/[0-9]/",$password)))
            $errors[] = "wrong_characters";
        if($password_again!="" && $password!=$password_again){
            $errors[] = "passwords_not_match";
        }

        //Birth_date
        if (!empty($birth_date)) {
            $birth_date_split = explode("-", $birth_date);
            if ($birth_date_split[0] < 1930 || $birth_date_split[0] > 2025) {
                $errors[] = "invalid_year";
            }
        }

        return $errors;

    }

    /**
     * Returns with the User if login is successful.
     * @param array $data (form's data)
     * @return User|null
     */
    public function login(array $data): ?User {
        $user = $this->userDAO->getByEmail($data["email"]);

        if ($user && password_verify($data["password"], $user->getPassword())) {
            return $user;
        }
        return null;
    }


    /**
     * Handle Register. Returns true if its succeed.
     * @param array $data
     * @return bool (returns if the action was successful)
     */
    public function registerUser(array $data): bool {
        $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);

        $user = new User(
            $data["email"],
            $data["username"],
            $data["surname"],
            $data["first_name"],
            $hashedPassword,
            $data["birth_date"],
            null,
            0
        );

        return $this->userDAO->create($user);
    }

    /**
     * Change User's password.
     * @param string $email
     * @param $data
     * @return array (returns errors)
     */
    public function changePassword(string $email, $data): array {
        $errors = [];
        $user = $this->userDAO->getByEmail($email);

        $oldPassword = $data['old_password'];
        $newPassword = $data['new_password'];
        $newPasswordConfirm = $data['new_password_confirm'];

        if (!$user) {
            $errors[] = "user_not_found";
        }

        if ($user && !password_verify($oldPassword, $user->getPassword())) {
            $errors[] = "wrong_password";
        }
        if ($newPassword !== $newPasswordConfirm) {
            $errors[] = "passwords_not_equal";
        }

        if (empty($errors)) {
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $user->setPassword($passwordHash);
            $this->userDAO->updatePassword($user);
        }

        return $errors;
    }

    /**
     * Deletes User.
     * @param string $email
     * @return bool (returns if the action was successful)
     */
    public function deleteAccount(string $email): bool {
        return $this->userDAO->deleteByEmail($email);
    }
}
