<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Sample Response
$data = [
    "status" => "success",
    "message" => "PHP Backend is working!"
];

echo json_encode($data);
?>
