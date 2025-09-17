<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// kalau method OPTIONS, langsung keluar (biar preflight sukses)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Set header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Mengimpor file konfigurasi dan model
include_once '../../config/database.php';
include_once '../../core/Teacher.php';


$database = new Database();
$db = $database->getConnection();
$teacher = new Teacher($db);

// Panggil metode read() dari model Fajar
$stmt = $teacher->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $teachers_arr = array();
    $teachers_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $teacher_item = array(
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "created_at" => $created_at,
        );
        array_push($teachers_arr["records"], $teacher_item);
    }
    http_response_code(200);
    echo json_encode($teachers_arr);
} else {
    http_response_code(404); 
    echo json_encode(array("message" => "Tidak ada guru ditemukan."));
}
?>