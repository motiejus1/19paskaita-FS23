<?php include("classes/shopDatabase-class.php"); ?>
<?php 

$shopDatabase = new ShopDatabase();
$shopDatabase->createProduct();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create product</title>
</head>
<body>
    <h1>Create product</h1>
    <form method="post" enctype="multipart/form-data">
        <input class="form-control" name="title" placeholder="Title" >
        <input class="form-control" name="description" placeholder="Description" >
        <input class="form-control" name="price" placeholder="Price" >
        <select class="form-select" name="category_id">
            <?php 
                $categories = $shopDatabase->getCategories();
                foreach($categories as $category) { ?>
                    <option value="<?php echo $category["id"] ?>"><?php echo $category["title"]; ?></option>
                <?php } ?>
        </select>
        <input type="file" name="image_url"/>
        <button class="btn btn-primary" type="submit" name="submit">Create</button>
    </form>
</body>
</html>