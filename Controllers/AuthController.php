<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../E_Commerce/models/UserModel.php';
require_once '../E_Commerce/models/AdminModel.php';

class AuthController {
    private $userModel;
    private $adminModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
        $this->adminModel = new AdminModel($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            if ($this->adminModel->login($username, $password)) {
                header('Location: /E_Commerce/views/admin_dashboard.php');
                exit();
            } elseif ($this->adminModel->login($username, $password)) {
                header('Location: /E_Commerce/views/product_list.php');
                exit();
            } else {
                $error = "Invalid username or password.";
                include '../E_Commerce/views/login.php';
            }
        } else {
            include '../E_Commerce/views/login.php';
        }
    }
public function signup() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        if ($this->adminModel->signup($username, $password)) {
            echo "Signup successful! Redirecting...";
            header('Location: /E_Commerce/views/login.php');
            exit();
        } else {
            echo "Signup failed! Please try again.";
            $error = "Signup failed. Please try again.";
            include '../E_Commerce/views/signup.php';
        }
    } else {
        include '../E_Commerce/views/signup.php';
    }
}

}
