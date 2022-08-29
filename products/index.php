<?php include("classes/shopDatabase-class.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <table class="table table-striped">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        <?php 
            $products = new ShopDatabase();
            $products = $products->getProducts();
            foreach($products as $product) {
        ?>
            <tr>
                <td><?php echo $product["id"]; ?></td>
                <td><?php echo $product["title"]; ?></td>
                <td><?php echo $product["description"]; ?></td>
                <td><?php echo $product["price"]; ?></td>
                <td><img src="<?php echo $product["image_url"]; ?>"/></td>
                <td><?php echo $product["categoryTitle"]; ?></td>
                <td>Tuščias Žaislai vaikams</td>
            </tr>
        <?php }
        ?>
    </table>
</body>
</html>