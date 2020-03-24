<?php

require_once __DIR__.'/../models/Category.php';
use app\models\Category;

class CategoryController {


  public function countAllProductsByCategory()
  {
    global $database;

    $categoryModel = new Category($database);
    $countAllProductsByCategory = $categoryModel -> countAllProductsByCategory();
    view('pages/home', ['productsByCategory' => $countAllProductsByCategory]);
  }

  public function displayAllCategories()
  {
    global $database;

    $categoryModel = new Category($database);
    $allCategories = $categoryModel -> countAllProductsByCategory();

    includeAdminFiles('/categories', ['allCategories' => $allCategories]);


  }

  public function displayCategoryNamesDropdown()
  {
    global $database;
    $categoryModel = new Category($database);
    $allCategories = $categoryModel -> getAllCategories();

    includeAdminFiles('/add_product', ['allCategories' => $allCategories]);

  }
  public function newCategory($val)
  {
    global $database;
    $categoryModel = new Category($database);
    $categoryModel -> addCategory($val);

    


  }

  public function displayCategoryNameById($id)
  {
    global $database;
    $categoryModel = new Category($database);
    $cat_name = $categoryModel -> getCategoryName($id);
    return $cat_name;

  }

  public function displayCategoryById($id)
  {
    global $database;
    $categoryModel = new Category($database);
    $category = $categoryModel -> getCategory($id);

    includeAdminFiles('/edit_category', ['category' => $category]);


  }

  public function updateCategoryName($value, $id)
  {
    global $database;
    $categoryModel = new Category($database);
    $categoryModel -> editCategoryName($value, $id);


  }

  public function removeCategory($id)
  {
    global $database;
    $categoryModel = new Category($database);
    $categoryModel -> unavailableCategory($id);

    header('Content-type: application/json');
    echo json_encode(['removed' => true]);
  }

  public function displayBackCategory($id)
  {
    global $database;
    $categoryModel = new Category($database);
    $categoryModel -> availableCategory($id);

    header('Content-type: application/json');
    echo json_encode(['backed' => true]);
  }


}
