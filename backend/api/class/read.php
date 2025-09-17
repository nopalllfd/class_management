<?php
// Set headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../core/class.php';

$database = new Database();
$db = $database->getConnection();
$class = new Classes($db);

$stmt = $class->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $classes_arr = array();
    $classes_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $class_item = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "teacher_name" => $row['teacher_name'],
            "created_at" => $row['created_at']
        );
        array_push($classes_arr["records"], $class_item);
    }
    
    // Set success response code and output JSON
    http_response_code(200);
    echo json_encode($classes_arr);
    
} else {
    // Set not found response code and output error message
    http_response_code(404);
    echo json_encode(array("message" => "No classes found."));
}
?>