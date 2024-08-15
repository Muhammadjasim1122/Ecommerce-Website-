<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Must be the first thing in the file

require_once '/var/www/html/E_Commercenew/E_Commerce/config/database.php'; // Adjust path if necessary
require_once '/var/www/html/E_Commercenew/E_Commerce/Controllers/AdminController.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/models/AdminModel.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/Controllers/AuthController.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/Controllers/UserauthController.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/Controllers/categoryController.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/Controllers/UserController.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/Controllers/catProductController.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/models/ProductModel.php';
// require_once '/var/www/html/E_Commercenew/E_Commerce/Controllers/CategoryModel.php';


$database = new Database();
$db = $database->getConnection();

// $categoryModel = new CategoryModel($db);
// $productModel = new ProductModel($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';



switch ($action) {
    case 'login':
        $controller = new AuthController($db);
        $controller->login();
        break;

    case 'signup':
        $controller = new AuthController($db);
        $controller->signup();
        break;

    case 'user_login':
      
            $controller = new userAuthController($db);
            $controller->user_login();
            break;
    
    case 'user_signup':
            $controller = new userAuthController($db);
            $controller->user_signup();
            break;
    

    case 'add_product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new AdminController($db);
            $controller->addProduct();
        } else {
            include '../E_Commercenew/E_Commerce/views/admin_dashboard.php'; // Use the correct relative path
        }
        break;

    case 'view_all_products':
            $controller = new AdminController($db);
            $controller->viewAllProducts();
            break;

    case 'delete_product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new AdminController($db);
        $controller->deleteProduct();
        }
        break;

    case 'add_to_cart':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new UserController($db);
        return $controller->addToCart();
        }
        break;
    case 'update_product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new AdminController($db);
        $controller->updateProduct();
        }
        break;

    case 'view_orders':
        $controller = new AdminController($db);
        $controller->viewOrders();
        break;

    case 'view_all':
     
        $products = (new productModel($db))->viewAll();
        $categories = (new productModel($db))->viewAllcategories();

        // Pass the products data to the view
        include '/var/www/html/E_Commercenew/E_Commerce/views/landing_page.php';   
        break;

    case 'view_cart':
        $controller = new UserController($db);
        $controller->viewCart();
        break;

    case 'checkout':
        $controller = new UserController($db);
        $controller->checkout();
        break;

        case 'delete_from_cart':
            $controller = new UserController($db);
            $controller->deleteFromCart();
            break;

    case 'add_category':
        $name = $_POST['category_name'];
        $categoryController = new categoryController($db);
        $categoryController->addCategory($name);
        header('Location: /E_Commercenew/E_Commerce/routes.php?action=admin_dashboard');

        break;

    case 'admin_dashboard':
        $ct = new categoryController($db);
        $categories = $ct->listCategories(); // Fetch categories
        include 'views/admin_dashboard.php'; // Pass categories to the view
        break;
        
    case 'view_category':
        $categoryId = $_GET['categoryId'];
        $categwiseProduct = (new ProductModel($db))->getProductsByCategory($categoryId);
        include '/var/www/html/E_Commercenew/E_Commerce/views/category_view.php'; // Use the correct relative path
        break;
                        
    default:
        include '../E_Commerce/views/admin_dashboard.php'; // Use the correct relative path
        break;
}
?>
