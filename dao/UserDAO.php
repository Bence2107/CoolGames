<?php

class UserDAO {
    private PDO $db;
    private string $tableName = "users";

    public function __construct(PDO $connection)
    {
        $this->db = $connection;
    }

    /**
     * Executes User query if exits
     * @param PDOStatement $stmt
     * @return User|null
     */
    private function getUser(PDOStatement $stmt) : ?User {
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data) {
            return new User(
                $data['email'], $data['username'], $data['surname'], $data['first_name'],
                $data['password'], $data['birth_date'], $data['profile_picture'], (int)$data['cat_credit']
            );
        }
        return null;
    }

    /**
     * Get User by email, if exits.
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email) : ?User {
        $sql = "SELECT * FROM $this->tableName WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        return $this->getUser($stmt);
    }

    /**
     * Get User by username, if exits.
     * @param string $username
     * @return User|null
     */
    public function getByUsername(string $username) : ?User {
        $sql = "SELECT * FROM $this->tableName WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":username", $username);
        return $this->getUser($stmt);
    }

    /**
     * Registries a User.
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        $sql = "INSERT INTO $this->tableName 
                (email, username, surname, first_name, password, birth_date, profile_picture, cat_credit)
                VALUES 
                (:email, :username, :surname, :first_name, :password, :birth_date, :profile_picture, :cat_credit)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":username", $user->getUsername());
        $stmt->bindValue(":surname", $user->getSurname());
        $stmt->bindValue(":first_name", $user->getFirstName());
        $stmt->bindValue(":password", $user->getPassword());
        $stmt->bindValue(":birth_date", $user->getBirthdate());
        $stmt->bindValue(":profile_picture", $user->getProfilePicture(), PDO::PARAM_LOB);
        $stmt->bindValue(":cat_credit", $user->getCatCredit());

        return $stmt->execute();
    }

    /**
     * Update User by username, surname, first name, birthdate.
     * @param User $user
     * @return bool
     */
    public function updateUserInfo(User $user): bool
    {
        $sql = "UPDATE $this->tableName SET 
                username = :username, 
                surname = :surname, 
                first_name = :first_name, 
                birth_date = :birth_date
                WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':surname', $user->getSurname());
        $stmt->bindValue(':first_name', $user->getFirstname());
        $stmt->bindValue(':birth_date', $user->getBirthdate());
        $stmt->bindValue(':email', $user->getEmail());

        return $stmt->execute();
    }

    /**
     * Update User's password.
     * @param User $user
     * @return bool
     */
    public function updatePassword(User $user): bool {
        $sql = "UPDATE $this->tableName SET 
                password = :password
                WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':email', $user->getEmail());

        return $stmt->execute();
    }

    /**
     * Update User's profile picture.
     * @param User $user
     * @return bool
     */
    public function updateProfilePicture(User $user): bool
    {
        $sql = "UPDATE $this->tableName SET 
                profile_picture = :profile_picture
                WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':profile_picture', $user->getProfilePicture(), PDO::PARAM_LOB);
        $stmt->bindValue(':email', $user->getEmail());

        return $stmt->execute();
    }

    /**
     * Update User's cat credit.
     * @param User $user
     * @return bool
     */
    public function updateCatCredit(User $user): bool {
        $sql = "UPDATE $this->tableName SET cat_credit = :cat_credit WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':cat_credit', $user->getCatCredit());
        $stmt->bindValue(':email', $user->getEmail());
        return $stmt->execute();
    }

    /**
     * Deletes User by email.
     * @param string $email
     * @return bool
     */
    public function deleteByEmail(string $email): bool {
        $sql = "DELETE FROM $this->tableName WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        return $stmt->execute();
    }
}