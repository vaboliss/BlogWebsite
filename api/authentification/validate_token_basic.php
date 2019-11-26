<?php


include_once "../../../../php/vendor/firebase/php-jwt/src/BeforeValidException.php";
include_once "../../../../php/vendor/firebase/php-jwt/src/ExpiredException.php";
include_once "../../../../php/vendor/firebase/php-jwt/src/SignatureInvalidException.php";
include_once "../../../../php/vendor/firebase/php-jwt/src/JWT.php";

use \Firebase\JWT\JWT;


function validate_token($token, $key)
{
    try {
        $decoded = JWT::decode($token, $key, array('HS256'));
        $user = $decoded->data;
        return $user;
    } catch (Exception $e) {
        return null;
    }
    return null;
}
