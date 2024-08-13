    <?php
    class QuoteModel {
    private $conn;
    private $table_name = "quote"; // Updated table name

    public function __construct($db) {
        $this->conn = $db;
    }
    public function addToCart($product_id, $name, $price, $quantity, $image) {
        $query = "INSERT INTO " . $this->table_name . " (product_id, name, price, quantity, image) VALUES (:product_id, :name, :price, :quantity, :image)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            return "true";
        } else {
            // Output error message
            $errorInfo = $stmt->errorInfo();
            echo json_encode(["message" => "Failed to add item to cart. Error: " . $errorInfo[2]]);
            exit();
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
