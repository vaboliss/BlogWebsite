<?php

class User
{
    //DB stuff
    private $conn;
    private $table = 'users';
    //Post proterties
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $privileges;
    //Constructor

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query =
            'INSERT INTO ' . $this->table . '
            SET first_name = :firstName,
                last_name = :lastName,
                email = :email,
                password = :password,
                privileges = :privileges';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':privileges', $this->privileges);

        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(':password', $password_hash);
        $status = null;
        try {
            $status = $stmt->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
        }
        if ($status) {
            return true;
        } else {
            return false;
        }
    }
    public function emailExists()
    {
        $query =
            "SELECT id,first_name,last_name,password,privileges
            FROM " . $this->table . "
            WHERE email = ?
            LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(1, $this->email);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo $error = $e->getMessage();
            return true;
        }

        $num = $stmt->rowCount();
        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->firstName = $row['first_name'];
            $this->lastName = $row['last_name'];
            $this->password = $row['password'];
            $this->privileges = $row['privileges'];

            return true;
        } else {
            return false;
        }
    }
}
