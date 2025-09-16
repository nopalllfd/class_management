<?php
// Set header untuk mengizinkan permintaan CORS dan output JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Mengimpor file konfigurasi dan model
include_once '../../config/database.php';
include_once '../../core/Student.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->email)) {

    $student->name = $data->name;
    $student->email = $data->email;

    if ($student->create()) {
        http_response_code(201); 
        echo json_encode(array("message" => "Siswa berhasil dibuat."));
    } else {
        http_response_code(503); 
        echo json_encode(array("message" => "Gagal membuat siswa."));
    }
} else {
    http_response_code(400); 
    echo json_encode(array("message" => "Data tidak lengkap."));
}
?>