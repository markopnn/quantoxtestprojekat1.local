<?php


$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();


/**
 * Class Database
 * The class is database connection.
 *
 * @package    quantoxtestprojekat1.local
 * @author     Marko Milojkovic <marko.milojkovic@quantox.com>
 *
 *
 */

class Database {

    /**
     * @return PDO
     */
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