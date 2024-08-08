<?php
require_once '../E_Commerce/models/ProductModel.php';
require_once '../E_Commerce/views/Product_list.php';
require_once '../E_Commerce/views/update_product.php';



class AdminController {
    private $db;
    private $productModel;

    public function __construct($db) {
        $this->db = $db;
        $this->productModel = new ProductModel($db);
    }

    public function addProduct() {
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantities = $_POST['quantities'];
        $image = $_FILES['image']['name'];
        $target = "../E_Commerce/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        if ($this->productModel->isProductIdExists($product_id)) {
            $_SESSION['message'] = "Product ID already exists!";
        } else if ($this->productModel->addProduct($product_id, $name, $price, $quantities, $image)) {
            $_SESSION['message'] = "Product added successfully!";
        } else {
            $_SESSION['message'] = "Failed to add product.";
        }
        
        header("Location: /E_Commerce/routes.php?action=admin_dashboard");
        exit();
    }
    public function viewAllProducts() {
        $products = $this->productModel->getAllProducts();
        
        if (!$products) {
            $_SESSION['message'] = "Failed to retrieve products.";
            header("Location: /E_Commerce/routes.php?action=admin_dashboard");
            exit();
        }
    
        // Include the view and pass the data to it
        include '../E_Commerce/views/Product_list.php';
    }

    public function viewOrders() {
        // Implement viewOrders method to display orders
    }


   
    public function fetchProduct($id) {
        return $this->productModel->fetchProduct($id); // Fetch product from the database
    }
    
    public function updateProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle POST request
            // Update product logic here
        } else {
            // Handle GET request
            $id = intval($_GET['id']);
            $product = $this->fetchProduct($id);
            include '../E_Commerce/views/update_product.php'; // Pass product data to the view
        }
    }
   
    
    public function deleteProduct() {
        $product_id = $_POST['id'];
        if ($this->productModel->deleteProduct($product_id)) {
            $_SESSION['message'] = "Product deleted successfully!";
        } else {
            $_SESSION['message'] = "Failed to delete product!";
        }
        header("Location: /E_Commerce/routes.php?action=view_all_products");
        exit();
    }
  
   
}
?>
