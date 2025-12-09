<?php

class UserDAO {
    private PDO $db;
    private string $tableName = "felhasznalo";

    public function __construct(PDO $connection)
    {
        $this->db = $connection;
    }

    public function getByEmail(string $email) : ?User {
        $sql = "SELECT * FROM $this->tableName WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data) {
            return new User(
                $data['email'], $data['felhasznalo_nev'], $data['veznev'], $data['kernev'],
                $data['jelszo'], $data['szul_datum'], $data['profilkep'], (int)$data['macskakredit']
            );
        }
        return null;
    }

    public function getByUsername(string $username) : ?User {
        $sql = "SELECT * FROM $this->tableName WHERE felhasznalo_nev = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":username", $username);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data) {
            return new User(
                $data['email'], $data['felhasznalo_nev'], $data['veznev'], $data['kernev'],
                $data['jelszo'], $data['szul_datum'], $data['profilkep'], (int)$data['macskakredit']
            );
        }
        return null;
    }

    public function create(User $user): bool
    {
        $sql = "INSERT INTO $this->tableName 
                (email, felhasznalo_nev, veznev, kernev, jelszo, szul_datum, szul_datum, macskakredit)
                VALUES 
                (:email, :username, :firstname, :surname, :password, :birthdate, :catcredit)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":username", $user->getUsername());
        $stmt->bindValue(":surname", $user->getSurname());
        $stmt->bindValue(":firstname", $user->getFirstName());
        $stmt->bindValue(":password", $user->getPassword());
        $stmt->bindValue(":birthdate", $user->getBirthdate());
        $stmt->bindValue(":catcredit", $user->getCatcredit());

        return $stmt->execute();
    }

    public function updateUserInfo(User $user): bool
    {
        $sql = "UPDATE $this->tableName SET 
                veznev = :vn, 
                kernev = :kn, 
                felhasznalo_nev = :un, 
                szul_datum = :szd
                WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':vn', $user->getSurname());
        $stmt->bindValue(':kn', $user->getFirstname());
        $stmt->bindValue(':un', $user->getUsername());
        $stmt->bindValue(':szd', $user->getBirthdate());
        $stmt->bindValue(':email', $user->getEmail());

        return $stmt->execute();
    }

    public function updatePassword(User $user): bool {
        $sql = "UPDATE $this->tableName SET 
                jelszo = :jelszo
                WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':jelszo', $user->getPassword());
        $stmt->bindValue(':email', $user->getEmail());

        return $stmt->execute();
    }

    public function updateProfilePicture(User $user): bool
    {
        $sql = "UPDATE $this->tableName SET 
                profilkep = :pk
                WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':pk', $user->getProfilepicture(), PDO::PARAM_LOB);
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