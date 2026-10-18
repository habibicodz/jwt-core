<?php
namespace App;

use App\jwt\JwtUtil;

class AuthUtil
{
    public static $valid_email = "test@gmail.com";
    public static $valid_password = "12345";

    public static function isAuthenticated(): bool
    {
        return isset($_REQUEST['Authorization']);
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