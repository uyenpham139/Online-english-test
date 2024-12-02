<?php 

require_once __DIR__ . '/../vendor/autoload.php'; // Adjust path as needed

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Dbh {
    private $username;
    private $password;
    private $host;
    private $db;
    protected $mysqli;

    protected function connect() {
        $this->username = $_ENV["MYSQL_USER"];
        $this->password = $_ENV["MYSQL_PASSWORD"];
        $this->host = $_ENV["MYSQL_HOST"];
        $this->db = $_ENV["MYSQL_DB"];

        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->db);
        if ($this->mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $this->mysqli -> connect_error;
            exit();
        }
        return $this->mysqli;
    }

}

