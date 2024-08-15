<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '/var/www/html/E_Commercenew/E_Commerce/models/UserModel.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/models/AdminModel.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/models/ProductModel.php';

class userAuthController {
    private $userModel;
    private $adminModel;
    private $productModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
        $this->adminModel = new AdminModel($db);
        $this->productModel = new ProductModel($db);
    }

    public function user_login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            if ($this->userModel->user_login($username, $password)) {
                // $products = $this->productModel->viewAll();
                // $categories = $this->productModel->viewAllcategories();
        
                // Pass the products data to the view
                // include '/var/www/html/E_Commercenew/E_Commerce/views/landing_page.php';     
                    header ("location: /E_Commercenew/E_Commerce/routes.php?action=view_all");

                exit();
            } else {
                $error = "Invalid username or password.";
                include '/var/www/html/E_Commercenew/E_Commerce/views/user_login.php';
            }
        } else {
            include '/var/www/html/E_Commercenew/E_Commerce/views/landing_page.php';
        }
    }
public function user_signup() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        if ($this->userModel->user_signup($username, $password)) {
            echo "Signup successful! Redirecting...";
            header('Location: /E_Commercenew/E_Commerce/views/user_login.php');
            exit();
        } else {
            echo "Signup failed! Please try again.";
            $error = "Signup failed. Please try again.";
            include '/var/www/html/E_Commercenew/E_Commerce/views/user_signup.php';
        }
    } else {
        include '/var/www/html/E_Commercenew/E_Commerce/views/user_signup.php';
    }
}

}
