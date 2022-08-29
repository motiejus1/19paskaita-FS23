<?php

include ("classes/databaseConnection-class.php");

class ShopDatabase extends DatabaseConnection {
    public $products;
    public $categories;

    public function __construct() {
        parent::__construct();
    }

    public function getProducts() {
        $this->products = $this->selectWithJoin("products","categories","category_id","id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "products.image_url", "categories.title AS categoryTitle"]);
        return $this->products;
    }


}