<?php
require_once '/var/www/html/E_Commercenew/E_Commerce/models/CategoryModel.php';


class CategoryController {
    private $categoryModel;
    

    public function __construct($pdo) {
        $this->categoryModel = new Category($pdo);
    }

    public function listCategories() {
        return $this->categoryModel->getAllCategories();
    }

    public function addCategory($name) {
        $this->categoryModel->addCategory($name);
        $_SESSION['message'] = "Category added successfully!";
    }
    public function viewCategory($category) {
        
        if ($categoryId !== null) {
            $products = $this->productModel->getProductsByCategory($categoryId);
            $categoryName = ucfirst($category); // Capitalize first letter for display
            include_once '/E_Commercenew/E_Commerce/views/category_view.php'; // Adjust path as necessary
        } else {
            // Handle category not found
            echo "Category not found.";
        }
    }
    public function getCategories() {
        return $this->categoryModel->getCategories();
    }

}


?>
