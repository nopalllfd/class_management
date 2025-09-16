<?php
class Teacher {
    private $conn;
    private $table_name = "teachers";

    public $id;
    public $name;
    public $email;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, email) VALUES (:name, :email)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);

        return $stmt->execute();
    }

   
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
