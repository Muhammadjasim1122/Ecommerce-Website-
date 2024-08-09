<?php
require_once '../E_Commerce/models/ProductModel.php';
require_once '../E_Commerce/views/Product_list.php';



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
    public function updateProduct() {
        $product_id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $image = $_FILES['image']['name'];
        $target = "../E_Commerce/" . basename($image);
    
        // Update only if a new image is uploaded
        if (!empty($image)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        } else {
            // If no new image, keep the old image
            $existingProduct = $this->productModel->getProductById($product_id);
            $image = $existingProduct['image'];
        }
    
        if ($this->productModel->updateProduct($product_id, $name, $price, $quantity, $image)) {
            $_SESSION['message'] = "Product updated successfully!";
        } else {
            $_SESSION['message'] = "Failed to update product.";
        }
    
        header("Location: /E_Commerce/routes.php?action=view_all_products");
        exit();
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
