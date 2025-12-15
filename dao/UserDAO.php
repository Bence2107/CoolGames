<?php

class UserDAO {
    private PDO $db;
    private string $tableName = "users";

    public function __construct(PDO $connection)
    {
        $this->db = $connection;
    }

    private function getUser($stmt) : ?User {
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

    public function getByEmail(string $email) : ?User {
        $sql = "SELECT * FROM $this->tableName WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        return $this->getUser($stmt);
    }

    public function getByUsername(string $username) : ?User {
        $sql = "SELECT * FROM $this->tableName WHERE felhasznalo_nev = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":username", $username);
        return $this->getUser($stmt);
    }

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

    public function updatePassword(User $user): bool {
        $sql = "UPDATE $this->tableName SET 
                password = :password
                WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':email', $user->getEmail());

        return $stmt->execute();
    }

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

    public function updateMoney(User $user): bool {
        $sql = "UPDATE $this->tableName SET cat_credit = :cat_credit WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':cat_credit', $user->getCatCredit());
        $stmt->bindValue(':email', $user->getEmail());
        return $stmt->execute();
    }

    public function deleteByEmail(string $email): bool {
        $sql = "DELETE FROM $this->tableName WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        return $stmt->execute();
    }
}