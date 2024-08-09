<?php
class ProductModel {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addProduct($product_id, $name, $price, $quantities, $image) {
        // Check if the product ID already exists
        if ($this->isProductIdExists($product_id)) {
            return false; // Product ID already exists
        }

        $query = "INSERT INTO " . $this->table_name . " (id, name, price, quantity, image) VALUES (:product_id, :name, :price, :quantities, :image)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantities', $quantities);
        $stmt->bindParam(':image', $image);

        return $stmt->execute();
    }
    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        
        if ($stmt->execute()) {
            return $stmt; // Return the PDOStatement object
        } else {
            // Debugging: Print the error
            echo "Error executing query: " . implode(" ", $stmt->errorInfo());
            return null;
        }
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
public function update($name, $price, $quantity, $image, $id) {
    $query = "UPDATE " . $this->table_name . " SET name = :name, price = :price, quantity = :quantity, image = :image WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}
}
?>
