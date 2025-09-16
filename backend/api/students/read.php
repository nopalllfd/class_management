<?php
// Set header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


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
        extract($row);
        $student_item = array(
            "id" => $id,
            "name" => $name,
            "email" => $email
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