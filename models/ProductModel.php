<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class ProductModel {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addProduct($name,$category_id,$price, $quantities, $image) {
        // Check if the product ID already exists
        if ($this->isProductIdExists($product_id)) {
            return false; // Product ID already exists
        }

        $query = "INSERT INTO " . $this->table_name . " (name,category_id, price, quantity, image) VALUES (:name, :category_id , :price, :quantities,  :image)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        // $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantities', $quantities);
        $stmt->bindParam(':image', $image);

        return $stmt->execute();
    }
    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
  
   
   
 
    public function isProductIdExists($product_id) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    public function deleteProduct($product_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        return $stmt->execute();
    }
    public function updateProduct($product_id, $name, $price, $quantity, $image) {
        $query = "UPDATE " . $this->table_name . " SET name = :name, price = :price, quantity = :quantity, image = :image WHERE id = :product_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':image', $image);

        return $stmt->execute();
    }

    public function getProductById($product_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function viewAll() {
        $query = "SELECT * FROM " . $this->table_name ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function viewAllcategories() {
        $query = "SELECT * FROM  categories" ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // public function getCategoryIdByName($category_name) {
    //     $query = "SELECT id FROM categories WHERE name = :name";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':name', $category_name);
    //     $stmt->execute();
        
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $result ? $result['id'] : false;
    // }
    
    public function getProductsByCategory($categoryId) {
        $query = "SELECT * FROM products WHERE category_id = :categoryId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
    }
    
}

?>
