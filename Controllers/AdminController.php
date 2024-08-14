<?php
require_once '/var/www/html/E_Commercenew/E_Commerce/models/ProductModel.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/views/Product_list.php';
    require_once '/var/www/html/E_Commercenew/E_Commerce/models/OrderModel.php'; // Add this line




class AdminController {
    private $db;
    private $productModel;
    private $orderModel; // Add this line


    public function __construct($db) {
        $this->db = $db;
        $this->productModel = new ProductModel($db);
        $this->orderModel = new orderModel($db);

    }

    public function addProduct() {
        // $product_id = $_POST['product_id'];
        $name = $_POST['name'];

        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
        // echo "post data <pre>";
        // print_r($_POST);
        // die();
        $quantities = $_POST['quantities'];
        $image = $_FILES['image']['name'];
        $target = "/var/www/html/E_Commercenew/E_Commerce/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);


        // if ($this->productModel->isProductIdExists($product_id)) {
        //     $_SESSION['message'] = "Product ID already exists!";
        // } 
        if ($this->productModel->addProduct($name, $category_id,$price, $quantities, $image)) {
            $_SESSION['message'] = "Product added successfully!";
        } else {
            $_SESSION['message'] = "Failed to add product.";
        }
        
        header("Location:/E_Commercenew/E_Commerce/routes.php?action=admin_dashboard");
        exit();
    }
    public function viewAllProducts() {
        $products = $this->productModel->getAllProducts();
        
        if (!$products) {
            $_SESSION['message'] = "Failed to retrieve products.";
            header("Location: /var/www/html/E_Commercenew/E_Commerce/routes.php?action=admin_dashboard");
            exit();
        }
    
        // Include the view and pass the data to it
        include '/var/www/html/E_Commercenew/E_Commerce//views/Product_list.php';
    }

    public function viewOrders() {
        $orders = $this->orderModel->getAllOrders();
        
        if (!$orders) {
            $_SESSION['message'] = "Failed to retrieve orders.";
            header("Location: /var/www/html/E_Commercenew/E_Commerce/routes.php?action=admin_dashboard");
            exit();
        }
    
        // Include the view and pass the data to it
        include '/var/www/html/E_Commercenew/E_Commerce/views/order_list.php'; // Add this line
        }
    public function updateProduct() {
        $product_id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $image = $_FILES['image']['name'];
        $target = "../E_Commercenew/E_Commerce/" . basename($image);
    
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
    
        header("Location:/E_Commercenew/E_Commerce/routes.php?action=view_all_products");
        exit();
    }
   
   
   
    public function deleteProduct() {
        $product_id = $_POST['id'];
        if ($this->productModel->deleteProduct($product_id)) {
            $_SESSION['message'] = "Product deleted successfully!";
        } else {
            $_SESSION['message'] = "Failed to delete product!";
        }
        header("Location:/E_Commercenew/E_Commerce/routes.php?action=view_all_products");
        exit();
    }
  
   
}
?>
