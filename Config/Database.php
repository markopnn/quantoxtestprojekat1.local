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

    private static $instance = null;
    private $conn;


    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->conn = new PDO("mysql:host={$_ENV['DB_SERVER']};
    dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'],$_ENV['DB_PASS'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }

    /**
     * @return Database|null
     */
    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->conn;
    }
}
?>