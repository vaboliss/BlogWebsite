<?php



include_once "../../../../php/vendor/firebase/php-jwt/src/BeforeValidException.php";
include_once "../../../../php/vendor/firebase/php-jwt/src/ExpiredException.php";
include_once "../../../../php/vendor/firebase/php-jwt/src/SignatureInvalidException.php";
include_once "../../../../php/vendor/firebase/php-jwt/src/JWT.php";

use \Firebase\JWT\JWT;

include_once '../../config/Database.php';
include_once '../../models/User.php';
include_once '../../config/core.php';

header("Access-Control-Allow-Origin: http://localhost/api/ ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$database = new Database();
$conn = $database->connect();


$user = new User($conn);
$user1 = new User($conn);

$data = json_decode(file_get_contents("php://input"));


if (
    !empty($data->email) &&
    !empty($data->password)
) {
    $user->email = $data->email;
    $user->password = $data->email;
    $email_exists = $user->emailExists();

    if ($email_exists && password_verify($data->password, $user->password)) {

        $token = array(
            "iss" => $iss,
            "aud" => $aud,
            "iat" => $iat,
            "nbf" => $nbf,
            "exp" => $exp,
            "data" => array(
                "id" => $user->id,
                "firstname" => $user->firstName,
                "lastname" => $user->lastName,
                "email" => $user->email,
                "privileges" => $user->privileges
            )
        );

        http_response_code(200);

        $jwt = JWT::encode($token, $key);

        echo json_encode(
            array(
                "message" => "Successful login",
                "jwt" => $jwt
            )
        );
    } else {

        http_response_code(400);

        echo json_encode(array("message" => "Login failed."));
    }
} else {

    http_response_code(400);

    echo json_encode(array("message" => "Data is not provided"));
}
