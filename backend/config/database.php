<?php
class Database {
    private $host = "localhost";
    private $db_name = "kelas";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";port=3309;dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");

            echo "Koneksi database berhasil!<br>";

        } catch(PDOException $exception) {
            echo "Koneksi gagal: " . $exception->getMessage() . "<br>";
        }

        return $this->conn;
    }
}

$db = new Database();
$conn = $db->getConnection();
?>
