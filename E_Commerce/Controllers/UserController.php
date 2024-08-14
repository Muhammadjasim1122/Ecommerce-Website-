<?php
require_once '/var/www/html/E_Commercenew/E_Commerce/config/database.php'; // Adjust path if necessary
require_once '/var/www/html/E_Commercenew/E_Commerce/models/ProductModel.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/models/QouteModel.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/models/OrderModel.php';


 // Ensure this file is included

class UserController {
    private $db;
    private $productModel;
    private $quoteModel;
    private $orderModel;



    public function __construct($db) {
        $this->db = $db;
        $this->productModel = new ProductModel($db);
        $this->quoteModel = new QuoteModel($db);
        $this->orderModel = new OrderModel($db);

    }
    
    public function AllProducts() {
        $products = $this->productModel->viewAll();
        $categories = $this->productModel->viewAllcategories();

        // Pass the products data to the view
        include '/var/www/html/E_Commercenew/E_Commerce/views/landing_page.php';
    }
    public function addToCart() {
        header('Content-Type: application/json');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
    
        // Fetch product details
        $product = $this->productModel->getProductById($product_id);
    
        if ($product) {
            $name = $product['name'];
            $price = $product['price'];
            $image = $product['image'];
    
            $success = $this->quoteModel->addToCart($product_id, $name, $price, $quantity, $image);  
            if ($success === "true") {
                return json_encode(["status" => "success"]);
            } else {
                return json_encode(["status" => "false"]);
            }
        } else {
            return json_encode(["message" => "Product not found."]);
        }
    }
    

    public function viewCart() {
        $quotes = $this->quoteModel->getCartContents();

        
        // Debugging output
        if (!$quotes) {
            error_log('No quotes returned from model.');
        }
        
        // Pass quotes to the view
        require '/var/www/html/E_Commercenew/E_Commerce/views/view_cart.php';
    }
    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ensure session is started if needed
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Get city from POST data
            $city = isset($_POST['city']) ? $_POST['city'] : '';

            // Calculate total
            $total = 0;
            $quotes = $this->quoteModel->getCartContents();

            if ($quotes) { // Check if quotes is not null
                while ($row = $quotes->fetch(PDO::FETCH_ASSOC)) {
                    $total += $row['price'] * $row['quantity'];
                }

                // Insert order
                $order_id = $this->orderModel->createOrder($total, $city);

                if ($order_id) {
                    // Clear cart
                    $this->quoteModel->clearCart();

                    // Redirect to landing page
                    header("Location: routes.php?action=view_all");
                    exit();
                } else {
                    // Handle order creation failure
                    echo "Error: Unable to create order.";
                }
            } else {
                // Handle case where $quotes is null
                echo "Error: Unable to fetch cart contents.";
            }
        } else {
            // Display checkout form
            $quotes = $this->quoteModel->getCartContents();
            require 'views/checkout.php';
        }
    }
    public function deleteFromCart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
    
            if ($product_id === null) {
                echo json_encode(['success' => false, 'message' => 'Product ID is missing.']);
                exit();
            }
            
            // Sanitize input
            $product_id = htmlspecialchars($product_id, ENT_QUOTES, 'UTF-8');
    
            // Attempt to delete item from cart
            $success = $this->quoteModel->deleteFromCart($product_id);
        
            if ($success) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Unable to delete item from cart.']);
            }
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            exit();
        }
    }
    
    
    
}
?>