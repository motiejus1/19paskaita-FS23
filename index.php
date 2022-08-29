<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href="assets/style.css" rel="stylesheet">

</head>
<body>
<div class="container">
        <ul class="nav">
            
        </ul>
        <?php 
            //pagal GET kintamaji mes busime nukreipiami į tam tikrus puslapius
        
            // if(isset($_GET["page"])) {
            //     if(($_GET["page"]) == "create") {
            //         include("movies/create.php");
            //     } else if(($_GET["page"]) == "update") {
            //         include("movies/update.php");
            //     } else if(($_GET["page"]) == "categories") {
            //         include("categories/index.php");
            //     } 
            // } else {
            //     include("movies/index.php");
            // }

            // $_GET["page"]
            // $_GET["action"] - veiksmas (CRUD action)

            // $_GET["page"] = "products" $_GET["action"] = "create" -> products/create.php
            // $_GET["page"] = "products" $_GET["action"] = "edit" -> products/edit.php
            // $_GET["page"] = "products" $_GET["action"] = "index" arba tuscias -> products/index.php

            // $_GET["page"] = "categories" $_GET["action"] = "create" -> categories/create.php
            // $_GET["page"] = "categories" $_GET["action"] = "edit" -> categories/edit.php
            // $_GET["page"] = "categories" $_GET["action"] = "index" arba tuscias -> categories/index.php

            if(isset($_GET["page"])) {
                if($_GET["page"] == "products" && $_GET["action"] == "create") {
                    include("products/create.php");
                } else if($_GET["page"] == "products" && $_GET["action"] == "edit") {
                    include("products/edit.php");
                } else if($_GET["page"] == "products" && ($_GET["action"] == "index" || !isset($_GET["action"]))) {
                    include("products/index.php");
                } else if($_GET["page"] == "categories" && $_GET["action"] == "create") {
                    include("categories/create.php");
                } else if($_GET["page"] == "categories" && $_GET["action"] == "edit") {
                    include("categories/edit.php");
                } else if($_GET["page"] == "categories" && ($_GET["action"] == "index" || !isset($_GET["action"]))) {
                    include("categories/index.php");
                } else {
                    include("products/index.php");
                }
            } else {
                include("products/index.php");
            }

        ?>
    </div>
</body>
</html>