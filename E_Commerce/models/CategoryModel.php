<?php
// require_once '/var/www/html/E_Commercenew/E_Commerce/config/database.php'; // Adjust path if necessary

class Category {
    private $db;

    public function __construct($db) {
        $this->db = $db; // Corrected this line
    }

    public function getAllCategories() {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($name) {
        $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->execute([':name' => $name]);
    }
    public function getCategoryIdByName($categoryName) {
        $query = "SELECT id FROM categories WHERE name = :name LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $categoryName);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['id'] : null;
    }
}
?>
