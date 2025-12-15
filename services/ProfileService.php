<?php

class ProfileService {
    private UserDAO $userDAO;

    public function __construct(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    /**
     * Validates User info change form and if's succeed, updates it.
     * @param string $email
     * @param array $postData
     * @return array|string[]|null (returns with errors)
     */
    public function updateUserInfo(string $email, array $postData): ?array {
        $errors = [];
        $user = $this->userDAO->getByEmail($email);

        if (!$user) {
            return ["user_not_found"];
        }

        $username = trim($postData["username"] ?? '');
        $surname = trim($postData["surname"] ?? '');
        $first_name = trim($postData["first_name"] ?? '');
        $birth_date = trim($postData["birth_date"] ?? '');

        if (empty($surname)) $surname = $user->getSurname() ?? '';
        if (empty($first_name)) $first_name = $user->getFirstname() ?? '';
        if (empty($username)) $username = $user->getUsername() ?? '';
        if (empty($birth_date)) $birth_date = $user->getBirthdate() ?? '';


        if (empty(trim($username))) {
            $errors[] = "empty_username";
        }

        if (empty(trim($surname))) {
            $errors[] = "empty_surname";
        }

        if (empty(trim($first_name))) {
            $errors[] = "empty_first_name";
        }

        if (trim(strlen($username) > 50)) {
            $errors[] = "long_username";
        }

        if (strlen($surname) > 45) {
            $errors[] = "long_surname";
        }

        if (trim(strlen($first_name) > 45)) {
            $errors[] = "long_first_name";
        }

        if ($username !== $user->getUsername()) {
            if ($this->userDAO->getByUsername($username)) {
                $errors[] = "username_already_exists";
            }
        }

        if (empty($errors)) {
            $user->setUsername($username);
            $user->setSurname($surname);
            $user->setFirstname($first_name);
            $user->setBirthdate($birth_date);

            $this->userDAO->updateUserInfo($user);
        }

        return $errors;
    }

    /**
     * Validate's profile picture, and if's succeed, updates it.
     * @param string $email
     * @param array $fileData
     * @return array|string[]|null
     */
    public function updateProfilePicture(string $email, array $fileData): ?array {
        $errors = [];

        $allowedTypes = ['jpg', 'png', 'jpeg'];
        $type = strtolower(pathinfo($fileData["name"] ?? '', PATHINFO_EXTENSION));

        if (($fileData["size"] ?? 0) > 3145728) {
            $_SESSION["fileSizeError"] = true;
            $errors[] = "fileSizeError";
        } else if (!in_array($type, $allowedTypes)) {
            $_SESSION["typeError"] = true;
            $errors[] = "typeError";
        }

        if (empty($errors)) {
            $user = $this->userDAO->getByEmail($email);
            if (!$user) {
                return ["user_not_found"];
            }

            $pictureData = file_get_contents($fileData["tmp_name"]);

            $user->setProfilePicture($pictureData);
            $this->userDAO->updateProfilePicture($user);
        }

        return $errors;
    }
}
