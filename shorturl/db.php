<?php
class DB {
    private $db;

    function __construct() {
        $this->connect_database();
    }

    public function getInstance() {
        return $this->db;
    }

    private function connect_database() {
        $host = "localhost";
        $dbname = "shorturl";
        $username = "root";
        $password = "root";


        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        } catch (PDOException $exception) {
            echo "Error: ".$exception->getMessage();
        }
    }
}

//$query_string = "SELECT * from links WHERE id = ?";
//
//$stmt = $pdo->prepare($query_string);
//$stmt->execute([3]);
//
//while ($link = $stmt->fetch(PDO::FETCH_ASSOC)) {
//    var_dump($link);
//}

//var_dump(PDO::getAvailableDrivers());