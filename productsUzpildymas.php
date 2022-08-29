<?php 

//1 prisijungti prie duomenu bazes
//2 sukurti 150 produktu. 150 kartu ivykdyti insert komanda;

include ("classes/databaseConnection-class.php");

for($i=0; $i<150; $i++) {
    $conn = new DatabaseConnection();
    $conn->insertAction("products", ["title","description","price", "category_id","image_url"], ["'product$i'", "'description$i'", "'".rand(1,10000)."'", "'".rand(1,3)."'", "'https://images.unsplash.com/photo-1472289065668-ce650ac443d2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80'"]);
}

?>