<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class UserModel {
    private $conn;
    private $table_name = "users"; // Updated to 'users'

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
        return false;
    }

    public function signup($username, $password) {
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
    
        if ($stmt->execute()) {
            return true;
        } else {
            // Debugging output
            print_r($stmt->errorInfo());
            return false;
        }
    }
}

