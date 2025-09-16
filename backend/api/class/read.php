<?php
// Set header
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
        extract($row);
        $class_item = array(
            "id" => $id,
            "name" => $name,
            "teacher_id" => $teacher_id
        );
        array_push($classes_arr["records"], $class_item);
    }
    http_response_code(200);
    echo json_encode($classes_arr);
} else {
    http_response_code(404); 
    echo json_encode(array("message" => "Tidak ada kelas ditemukan."));
}
?>