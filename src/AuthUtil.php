<?php
namespace App;

session_start();

use App\jwtcore\JwtUtil;

class AuthUtil
{
    public static $valid_email = "test@gmail.com";
    public static $valid_password = "12345";

    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['userid']);
    }


    public static function authenticate($data): ?string
    {
        $email = $data["email"];
        $password = $data["password"];

        $isValid = AuthUtil::$valid_email == $email && AuthUtil::$valid_password == $password;

        $jwt = ($isValid) ? JwtUtil::createJwt() : NULL;

        return $jwt;
    }
}
?>