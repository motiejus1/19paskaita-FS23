<?php

include ("classes/databaseConnection-class.php");

class ShopDatabase extends DatabaseConnection {
    public $products;
    public $categories;
    public $limit;

    public function __construct() {
        parent::__construct();
    }

    public function getProducts() {

        
        $page = $_GET["paginatorPage"] ?? 1;
        $limit = $_GET["limit"] ?? 10;
        
        //patartina
        $category_id = "";

        if(isset($_GET["category_id"])) {
            $category_id = $_GET["category_id"];
        } 

        //galima, bet geriau ne
        if(isset($_GET["sortCol"]) && isset($_GET["sortDir"])) {
            $sortCol = $_GET["sortCol"];
            $sortDir = $_GET["sortDir"];
        } else {
            $sortCol = "id";
            $sortDir = "ASC";
        }

        $this->products = $this->selectWithJoin("products","categories","category_id","id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "products.image_url", "categories.title AS categoryTitle"], $sortCol, $sortDir, $category_id, $limit, $page);
        return $this->products;
    }

    public function getCategories() {
        $this->categories = $this->selectAction("categories");
        return $this->categories;
    }

    public function createProduct() {
        if(isset($_POST["submit"])) {
            $product = array(
                "title" => $_POST["title"],
                "description" => $_POST["description"],
                "price" => $_POST["price"],
                "category_id" => $_POST["category_id"],
                "image_url" => $this->uploadImage($_FILES["image_url"]) //failo pavadinima $_FILES["image_url"]["name"]
            );
            $this->insertAction("products", ["title","description","price", "category_id","image_url"], ["'".$product["title"]."'", "'".$product["description"]."'", "'".$product["price"]."'", "'".$product["category_id"]."'", "'".$product["image_url"]."'"]);
        }
    }

    //sita metoda naudosim kito metodo viduje
    private function uploadImage($file) {
        var_dump($file);
        $fileDir = "images/";
        $fileTarget = $fileDir . basename($file["name"]);
        $fileType = strtolower(pathinfo($fileTarget, PATHINFO_EXTENSION));
        
        // if ($fileType != "jpg") {
            // echo "Failas turi buti jpg";
        // }

        if($file["error"] == 0) {
            if(move_uploaded_file($file["tmp_name"], $fileTarget)) {
                return $fileTarget;
            } else {
                return "images/default.jpg";
            }
        }
        return $fileTarget;
    }

    public function showPagination() {
        //$products = $this->getProducts();
        
        
        $productsCount = floatval($this->totalCount("products")[0]["totalCount"]);
        
        
        $limit = $_GET["limit"] ?? 10;
        $productsPerPage = $limit;

        //round
        //302 / 10 = 30.2 -> 30
        //ceil - apvalina iki didziausio skaiciaus
        //ceil 302/10 = 30.2 -> 31
        $pagesCount = ceil($productsCount / $productsPerPage);

        for($i = 1; $i <= $pagesCount; $i++) {
            echo "<a class='btn btn-primary' href='index.php?paginatorPage=$i&limit=$limit'>$i</a>";
        }

        return $pagesCount;
    }


}