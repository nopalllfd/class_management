<?php
// Set header untuk mengizinkan permintaan CORS dan output JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Mengimpor file konfigurasi dan model
include_once '../../config/database.php';
include_once '../../core/Teacher.php';

// Inisialisasi objek database dan teacher
$database = new Database();
$db = $database->getConnection();
$teacher = new Teacher($db);

// Mengambil data JSON yang dikirim
$data = json_decode(file_get_contents("php://input"));

// Memastikan data tidak kosong
if (!empty($data->name) && !empty($data->email)) {

    // Mengatur properti objek teacher
    $teacher->name = $data->name;
    $teacher->email = $data->email;

    // Panggil metode create() dari model Fajar
    if ($teacher->create()) {
        http_response_code(201); // 201 Created
        echo json_encode(array("message" => "Guru berhasil dibuat."));
    } else {
        http_response_code(503); // 503 Service Unavailable
        echo json_encode(array("message" => "Gagal membuat guru."));
    }
} else {
    http_response_code(400); // 400 Bad Request
    echo json_encode(array("message" => "Data tidak lengkap."));
}
?>