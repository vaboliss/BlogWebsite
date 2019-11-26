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
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';
include_once '../authentification/validate_token_basic.php';
include_once '../../config/core.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object

$data = json_decode(file_get_contents("php://input"));

$post = new Post($db);


//Get raw posted data
$jwt = isset($data->jwt) ? $data->jwt : "";

if (empty($data->id)) {
    echo json_encode(
        array('message' => 'id was not provided')
    );
    die();
}
if ($jwt == "") {
    echo json_encode(
        array('message' => 'Token is not provided')
    );
    die();
}
$user = validate_token($jwt, $key);

if (
    $user == null
) {
    echo json_encode(
        array('message' => 'Access denied, wrong token')
    );
    die();
}

if ($user->privileges == 'admin') {
    $post->id = $data->id;
    if ($post->delete()) {
        echo json_encode(
            array('message' => 'Post deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Post not deleted')
        );
    }
} else {
    $post->id = $data->id;

    $post->read_single();

    if ($post->author == $user->id) {
        $post->id = $data->id;
        if ($post->delete()) {
            echo json_encode(
                array('message' => 'Post deleted')
            );
        } else {
            echo json_encode(
                array('message' => 'Post not deleted')
            );
        }
    } else {
        echo json_encode(
            array('message' => 'Access denied. No privileges')
        );
    }
}
