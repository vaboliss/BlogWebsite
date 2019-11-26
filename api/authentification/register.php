<?php

include_once '../../config/Database.php';
include_once '../../models/User.php';

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$database = new Database();
$conn = $database->connect();

$user = new User($conn);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->firstname) &&
    !empty($data->lastname) &&
    !empty($data->email) &&
    !empty($data->password)
) {
    $user->firstName = $data->firstname;
    $user->lastName = $data->lastname;
    $user->email = $data->email;
    $user->password = $data->password;
    $user->privileges = "basic";
    if ($user->create()) {
        http_response_code(200);

        echo json_encode(array("Message" => "User was create"));
    } else {
        http_response_code(400);

        echo json_encode(array("Message" => "Unable to create user"));
    }
} else {
    http_response_code(400);

    echo json_encode(array("Message" => "Unable to create user parameters are empty"));
}
