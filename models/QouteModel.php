    <?php
    class QuoteModel {
    private $conn;
    private $table_name = "quote"; // Updated table name

    public function __construct($db) {
        $this->conn = $db;
    }
    public function addToCart($product_id, $name, $price, $quantity, $image) {
        // Check if product already exists in the cart
        $checkQuery = "SELECT id, quantity FROM " . $this->table_name . " WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existingItem) {
            // Update the quantity if product exists
            $newQuantity = $existingItem['quantity'] + $quantity;
            $updateQuery = "UPDATE " . $this->table_name . " SET quantity = :quantity WHERE product_id = :product_id";
            $stmt = $this->conn->prepare($updateQuery);
            $stmt->bindParam(':quantity', $newQuantity);
            $stmt->bindParam(':product_id', $product_id);
    
            if ($stmt->execute()) {
                return "true";
            } else {
                $errorInfo = $stmt->errorInfo();
                echo json_encode(["message" => "Failed to update quantity in cart. Error: " . $errorInfo[2]]);
                exit();
            }
        } else {
            // Insert new item if product does not exist
            $query = "INSERT INTO " . $this->table_name . " (product_id, name, price, quantity, image) VALUES (:product_id, :name, :price, :quantity, :image)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':image', $image);
    
            if ($stmt->execute()) {
                return "true";
            } else {
                $errorInfo = $stmt->errorInfo();
                echo json_encode(["message" => "Failed to add item to cart. Error: " . $errorInfo[2]]);
                exit();
            }
        }
    }
    

    public function getCartContents() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        // Debugging output
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            // Log or print if empty
            error_log('Quote table is empty.');
            return null;
        }
    }
    public function clearCart() {
        $query = "DELETE FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }
    // models/Quote.php

    public function deleteFromCart($product_id) {
    $stmt = $this->conn->prepare('DELETE FROM quote WHERE product_id = :product_id');
    return $stmt->execute(['product_id' => $product_id]);
    }
    
    }
    ?>
