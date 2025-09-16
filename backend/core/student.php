<?php
class Student {
    private $conn;
    private $table_name = "students";

    public $id;
    public $name;
    public $email;
    public $class_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, email, class_id) VALUES (:name, :email, :class_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":class_id", $this->class_id);

        return $stmt->execute();
    }

    // Read
    public function read() {
        $query = "SELECT s.id, s.name, s.email, c.name as class_name, s.created_at
                  FROM " . $this->table_name . " s
                  LEFT JOIN classes c ON s.class_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
