<?php

class ProfileService {
    private UserDAO $userDAO;

    public function __construct(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    public function updateUserInfo(string $email, array $postData): array {
        $errors = [];
        $user = $this->userDAO->getByEmail($email);

        if (!$user) { return ["user_not_found"]; }

        $veznev = trim($postData["veznev"] ?? '');
        $kernev = trim($postData["kernev"] ?? '');
        $username = trim($postData["username"] ?? '');
        $szul_datum = trim($postData["szul_datum"] ?? '');

        if (empty($veznev)) $veznev = $user->getSurname() ?? '';
        if (empty($kernev)) $kernev = $user->getFirstname() ?? '';
        if (empty($username)) $username = $user->getUsername() ?? '';
        if (empty($szul_datum)) $szul_datum = $user->getBirthdate() ?? '';


        if (strlen($veznev) > 45) {
            $errors[] = "long_veznev";
        }

        if ($username !== $user->getUsername()) {
            if ($this->userDAO->getByUsername($username)) {
                $errors[] = "username_contains";
            }
        }

        if (empty($errors)) {
            $user->setSurname($veznev);
            $user->setFirstname($kernev);
            $user->setUsername($username);
            $user->setBirthdate($szul_datum);

            $this->userDAO->updateUserInfo($user);
        }

        return $errors;
    }


    public function updateProfilePicture(string $email, array $fileData): array {
        $errors = [];

        $allowedTypes = ['jpg','png','jpeg'];
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
            if (!$user) { return ["user_not_found"]; }

            $pictureData = file_get_contents($fileData["tmp_name"]);

            $user->setProfilePicture($pictureData);
            $this->userDAO->updateProfilePicture($user);
        }

        return $errors;
    }
}
