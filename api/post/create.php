<?php
//Headers

include_once "../../../../php/vendor/firebase/php-jwt/src/BeforeValidException.php";
include_once "../../../../php/vendor/firebase/php-jwt/src/ExpiredException.php";
include_once "../../../../php/vendor/firebase/php-jwt/src/SignatureInvalidException.php";
include_once "../../../../php/vendor/firebase/php-jwt/src/JWT.php";

include_once "../../../../php/vendor/autoload.php";

use \Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';
include_once '../authentification/validate_token_basic.php';
include_once '../../config/core.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object

$post = new Post($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if (
    empty($data->title) &&
    empty($data->body) &&
    empty($data->category_id)
) {
    echo json_encode(
        array('message' => 'Missing data')
    );
    die();
}
$jwt = isset($data->jwt) ? $data->jwt : "";


if ($jwt == "") {
    echo json_encode(
        array('message' => 'Token is not provided')
    );
    die();
}
$user = validate_token($jwt, $key);
if (
    $user != null
) {

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $user->id;
    $post->category_id = $data->category_id;

    if ($post->create()) {
        echo json_encode(
            array('message' => 'Post Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Post not Created')
        );
    }
} else {
    echo json_encode(
        array('message' => 'Access denied, wrong token')
    );
    die();
}
