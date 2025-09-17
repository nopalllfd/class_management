<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../core/student.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

$data = json_decode(file_get_contents("php://input"));

// Check if all data fields are not empty
if (!empty($data->name) && !empty($data->email) && !empty($data->class_id)) {
    $student->name = $data->name;
    $student->email = $data->email;
    $student->class_id = $data->class_id;

    if ($student->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Student was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create student."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create student. Data is incomplete."));
}
?>