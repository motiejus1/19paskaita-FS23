<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Interpretuoja kaip teksta -->
    <form action="failuIkelimas.php" method="post" enctype="multipart/form-data">
        <input type="tekstas" name="tekstas">
        <input type="file" name="file">
        <button type="submit" name="submit">Upload </button>
    </form>
    <?php 
    //failo patalpinimas serveryje
    //failo pavadinimas mes dar turime irasyti i duomenu baze x

    $fileDir = "images/";

    
  

    if(isset($_POST["submit"])) {
        //pilnas kelias iki failo
        //failas.jpg -> images => images/failas.jpg
        //tekstas.pdf -> images => images/tekstas.pdf
        $fileTarget = $fileDir . basename($_FILES["file"]["name"]);
        //failo tipas
        $fileType = strtolower(pathinfo($fileTarget, PATHINFO_EXTENSION));
        
        // if ($fileType != "jpg") {
            // echo "Failas turi buti jpg";
        // }

        if($_FILES["file"]["error"] == 0) {
            //jeigu pavyko jinai ikelia faila ir grazina true
            //jeigu nepavyko grazina false
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $fileTarget)) {
                echo "Failas ikeltas sekmingai";
            } else {
                echo "Failo ikelti nepavyko";
            }
        }


        //echo  $fileType;
        var_dump($_FILES["file"]);
    }


    ?>
</body>
</html>