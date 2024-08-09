<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Must be the first thing in the file

require_once './config/database.php';
require_once '../E_Commerce/Controllers/AdminController.php';
require_once '../E_Commerce/models/AdminModel.php';
require_once '../E_Commerce/Controllers/AuthController.php';
require_once '../E_Commerce/Controllers/UserController.php';

$database = new Database();
$db = $database->getConnection();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'login':
        $controller = new AuthController($db);
        $controller->login();
        break;

    case 'signup':
        $controller = new AuthController($db);
        $controller->signup();
        break;

    case 'add_product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new AdminController($db);
            $controller->addProduct();
        } else {
            include '../E_Commerce/views/admin_dashboard.php'; // Use the correct relative path
        }
        break;

        case 'view_all_products':
            $controller = new AdminController($db);
            $controller->viewAllProducts();
            break;
        case 'update_product':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller = new AdminController($db);
                    $controller->updateProduct();
                } else {
                    // Display the update product form
                    $productId = intval($_GET['id']);
                    $controller = new AdminController($db);
                    $product = $controller->fetchOneProduct($productId);
                    include '../E_Commerce/views/update_product.php';
                }
                break;
        
        case 'delete_product':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller = new AdminController($db);
                    $controller->deleteProduct();
                }
                break;

    case 'view_orders':
        $controller = new AdminController($db);
        $controller->viewOrders();
        break;

    default:
        include '../E_Commerce/views/admin_dashboard.php'; // Use the correct relative path
        break;
}
?>
