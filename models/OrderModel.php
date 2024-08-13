<?php
class OrderModel {
    private $conn;
    private $table_name = "orders";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createOrder($total, $city) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, total, city) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Fetch user_id from the session or pass it as an argument if needed
        $user_id = 1; // Assuming a default value or get it from session if needed
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $total);
        $stmt->bindParam(3, $city);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }

    public function getAllOrders() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
