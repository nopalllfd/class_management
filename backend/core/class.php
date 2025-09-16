<?php
class Classes {
    private $conn;
    private $table_name = "classes";

    public $id;
    public $name;
    public $teacher_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, teacher_id) VALUES (:name, :teacher_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":teacher_id", $this->teacher_id);

        return $stmt->execute();
    }

    // Read
    public function read() {
        $query = "SELECT c.id, c.name, t.name as teacher_name, c.created_at
                  FROM " . $this->table_name . " c
                  JOIN teachers t ON c.teacher_id = t.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
