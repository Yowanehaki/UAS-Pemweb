<?php
// config/connection_oop.php
class Connection {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "sample_db";
    private $conn;

    // Constructor
    public function __construct() {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
// Mengembalikan koneksi
    public function getConnection() {
        return $this->conn;
    }
// Menutup koneksi
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
