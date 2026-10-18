<?php
namespace App\jwt;

use Exception;

class Base64Url
{
    // Encode to base64
    public static function encode($data): string
    {
        $encoded = base64_encode($data);
        $urlSafeEncoded = str_replace("=", "", $encoded);
        $urlSafeEncoded = str_replace("+", "-", $urlSafeEncoded);
        $urlSafeEncoded = str_replace("/", "_", $urlSafeEncoded);
        return $urlSafeEncoded;
    }


    // decode from base64
    public static function decode($data): string
    {
        $decoded = str_replace("-", "+", $data);
        $decoded = str_replace("_", "/", $decoded);

        switch (strlen($decoded) % 4) {
            case 0:
                break;

            case 2:
                $decoded .= "==";
                break;

            case 3:
                $decoded .= "=";
                break;

            default:
                throw new Exception("Illegal base64url string!", 1);
        }

        return base64_decode($decoded);
    }
}
?>