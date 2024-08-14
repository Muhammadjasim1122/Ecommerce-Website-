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

    public function addProduct($name, $price, $quantities, $image, $category_ids) {
        // Insert product into the products table
       
        $checkQuery = "SELECT id, quantity FROM " . $this->table_name . " WHERE name = :name";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
       
       
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if($existingitem)
        {
            $newquantity = $existingitem['quantity'] + $quantities;
            $updateQuary = "UPDATE" . $this->table_name . "SET quantity = :quantity WHERE product_id = :prdouct_id";
            $stmt->bindParam(':quantity', $newQuantity);
            $stmt->bindParam(':product_id', $product_id);
        }
       
       else
       {

         $query = "INSERT INTO " . $this->table_name . " (name, price, quantity, image) VALUES (:name, :price, :quantities, :image)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantities', $quantities);
        $stmt->bindParam(':image', $image);
    
        if (!$stmt->execute()) {
            return false;
        }
    

      
        // Get the last inserted product ID
        $product_id = $this->conn->lastInsertId();
    
        // Insert categories into the product_categories table
        foreach ($category_ids as $category_id) {
            $query = "INSERT INTO product_categories (product_id, category_id) VALUES (:product_id, :category_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':category_id', $category_id);
            if (!$stmt->execute()) {
                return false;
            }
        }
    
        return true;
    }
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
        // Start a transaction
        $this->conn->beginTransaction();
    
        // Delete related categories
        $query = "DELETE FROM product_categories WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $result1 = $stmt->execute();
    
        // Check if the deletion of related categories was successful
        if ($result1) {
            // Delete the product
            $query = "DELETE FROM products WHERE id = :product_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_id', $product_id);
            $result2 = $stmt->execute();
    
            // Check if the product deletion was successful
            if ($result2) {
                // Commit the transaction if everything was successful
                $this->conn->commit();
                return true;
            } else {
                // Roll back the transaction if product deletion failed
                $this->conn->rollBack();
                return false;
            }
        } else {
            // Roll back the transaction if category deletion failed
            $this->conn->rollBack();
            return false;
        }
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
   public function getProductsByCategory($categoryId) {
    // Query to get product IDs from product_categories table for the given category
    $query = "
        SELECT p.*
        FROM products p
        INNER JOIN product_categories pc ON p.id = pc.product_id
        WHERE pc.category_id = :categoryId
    ";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':categoryId', $categoryId);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
}
    
}

?>
