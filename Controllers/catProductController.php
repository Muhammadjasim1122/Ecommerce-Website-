<?php
require_once '/var/www/html/E_Commercenew/E_Commerce/models/CategoryModel.php';
require_once '/var/www/html/E_Commercenew/E_Commerce/models/ProductModel.php';

class CatProductController {
    private $categoryModel;
    private $productModel;

    public function __construct($db) {
        $this->categoryModel = $categoryModel; // Correctly assign CategoryModel
        $this->productModel = $productModel;   // Correctly assign ProductModel
    }

    public function viewCategory($category) {
        // Fetch category ID using the category model
 

        if ($categoryId !== null) {
            $products = $this->productModel->getProductsByCategory($categoryId);
            $categoryName = ucfirst($category); // Capitalize first letter for display
            include_once '/E_Commercenew/E_Commerce/views/category_view.php'; // Adjust path as necessary
        } else {
            // Handle category not found
            echo "Category not found.";
        }
    }
}
?>
