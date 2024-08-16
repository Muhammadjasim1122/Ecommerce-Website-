    <?php
    class QuoteModel {
    private $conn;
    private $table_name = "quote"; // Updated table name

    public function __construct($db) {
        $this->conn = $db;
    }
    public function addToCart($product_id, $name, $price, $quantity, $image) {
        // Check if product already exists in the cart
        $checkQuery = "SELECT id, quantity FROM " . $this->table_name . " WHERE product_id = :product_id AND order_id IS NULL";
    
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existingItem) {
            // Update the quantity if product exists
            $newQuantity = $existingItem['quantity'] + $quantity;
            $updateQuery = "UPDATE " . $this->table_name . " SET quantity = :quantity WHERE product_id = :product_id AND order_id IS NULL";
            $stmt = $this->conn->prepare($updateQuery);
            $stmt->bindParam(':quantity', $newQuantity);
            $stmt->bindParam(':product_id', $product_id);
        
            return $stmt->execute();
        } else {
            // Insert new item if product does not exist
            $query = "INSERT INTO " . $this->table_name . " (product_id, name, price, quantity, image) VALUES (:product_id, :name, :price, :quantity, :image)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':image', $image);
        
            return $stmt->execute();
        }
    }
    
    

    public function getCartContents() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE order_id IS NULL";
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
        $stmt = $this->conn->prepare('DELETE FROM quote WHERE product_id = :product_id AND order_id IS NULL');
        return $stmt->execute(['product_id' => $product_id]);
    }

    
    
    public function getCartCount() {
        $stmt = $this->conn->query('SELECT COUNT(*) AS count FROM quote');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
    public function updateOrderIdForCartItems($order_id) {
        $query = "UPDATE " . $this->table_name . " SET order_id = :order_id WHERE order_id IS NULL";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        return $stmt->execute();
    }
    
    
    
    }
    ?>
