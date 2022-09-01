<?php 

class DatabaseConnection {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "parduotuve";

    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            $this->conn->exec("set names utf8");
           // echo "Prisijungta prie duomenu bazes sekmingai";
        } catch(PDOException $e) {
           // echo "Prisijungti prie duomenu bazes nepavyko: " . $e->getMessage();
        }

    }
   
    public function selectAction($table, $col ="id", $sortDir ="ASC") {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table` WHERE 1 ORDER BY $col $sortDir";
            //pasiruosimas vykdyti
            $stmt = $this->conn->prepare($sql);
            //vykdyti
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;

        } catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }
   
    public function insertAction($table, $cols, $values) {


        $cols = implode(",", $cols);
        //masyva pavercia i teksta per skirtuka ["title", "description"] => "title,description"
        $values = implode(",", $values);//  ["test", "test"] => "test,test"

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql= "INSERT INTO `$table` ($cols) VALUES ($values)";
            //var_dump($sql);
            $this->conn->exec($sql);
            echo "Pavyko sukurti nauja irasa";

        } catch (PDOException $e) {
            echo "Nepavyko sukurti naujo iraso: " . $e->getMessage();
        }

    }

    public function deleteAction($table, $id) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `$table` WHERE id = $id";
            $this->conn->exec($sql);
            echo "Pavyko istrinti irasa";
        }
        catch(PDOException $e) {
            echo "Nepavyko istrinti iraso: " . $e->getMessage();
        }
    }

    public function updateAction($table, $id, $data) {
        $cols = array_keys($data);
        $values = array_values($data);

        $dataString = [];
        for ($i=0; $i<count($cols); $i++) {
           $dataString[] = $cols[$i] . " = '" . $values[$i]. "'";
        }
        $dataString = implode(",", $dataString);

       try{
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "UPDATE `$table` SET $dataString WHERE id = $id";
              $stmt = $this->conn->prepare($sql);
              $stmt->execute();
              echo "Pavyko atnaujinti irasa";
         } 
       catch(PDOException $e) {
              echo "Nepavyko atnaujinti iraso: " . $e->getMessage();
       }
    }

    public function selectOneAction($table, $id) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table` WHERE id = $id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }

    public function selectWithJoin($table1, $table2, $table1RelationCol, $table2RelationCol, $join, $cols, $sortCol ="id", $sortDir ="ASC", $category_id, $limit = 10, $page = 1) {

        $cols = implode(",", $cols);


        //category_id = "", WHERE 1
        //category_id = 2, WHERE products.category_id = categories.id

        // 10 puslpayje - fiksuotas skaicius
        //is kur as zinau?
        

        $filter = "1";

        if($category_id != "") {
            $filter = "products.category_id = $category_id";
        } 
        // page 1 - 0  ($page - 1) * $limit = 0*10 = 0
        //page 2 - 10  ($page - 1) * $limit = 1*10 = 10
        //page 3 - 20 ($page - 1) * $limit = 2*10 = 20
        //page 4 - 30 ($page - 1) * $limit = 3*10 = 30

        $offset = ($page - 1) * $limit;
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT $cols FROM $table1 
            $join $table2
            ON $table1.$table1RelationCol = $table2.$table2RelationCol
            WHERE $filter
            ORDER BY $sortCol $sortDir
            LIMIT $offset, $limit
            ";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }

    public function totalCount($table) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(*) AS totalCount FROM $table";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }


    public function __destruct() {
        $this->conn = null;
       // echo "Atjungta is duomenu bazes sekmingai";
    }


}

?>