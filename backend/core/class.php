<?php
class Classes {
    // Properti koneksi database dan nama tabel
    private $conn;
    private $table_name = "classes";

    // Properti objek
    public $id;
    public $name;
    public $teacher_id;
    public $created_at;

    // Konstruktor untuk koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Metode untuk membuat (CREATE) kelas baru
    public function create() {
        // Query untuk memasukkan data ke tabel classes
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, teacher_id=:teacher_id";
        
        $stmt = $this->conn->prepare($query);

        // Membersihkan data untuk mencegah SQL Injection
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->teacher_id = htmlspecialchars(strip_tags($this->teacher_id));

        // Mengikat nilai parameter
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":teacher_id", $this->teacher_id);

        // Eksekusi query dan kembalikan hasilnya
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Metode untuk membaca (READ) semua kelas
    public function read() {
        // Query untuk mengambil semua data kelas, dengan JOIN ke tabel teachers
        $query = "SELECT c.id, c.name, t.name as teacher_name, c.created_at
                  FROM " . $this->table_name . " c
                  JOIN teachers t ON c.teacher_id = t.id
                  ORDER BY c.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>