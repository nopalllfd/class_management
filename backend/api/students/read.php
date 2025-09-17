<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../../config/database.php';
include_once '../../core/student.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

$stmt = $student->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $students_arr = array();
    $students_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $student_item = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "email" => $row['email'],
            "class_id" => isset($row['class_id']) ? $row['class_id'] : null,
            "created_at" => $row['created_at'],
        );
        array_push($students_arr["records"], $student_item);
    }
    http_response_code(200);
    echo json_encode($students_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Tidak ada siswa ditemukan."));
}
?>