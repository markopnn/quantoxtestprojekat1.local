<?php


$dotenv =  $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

class Database {
    public function connect() {
        $servername = $_ENV['DB_SERVER'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
        $db_name = $_ENV['DB_NAME'];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db_name",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }
}


?>