<?php
namespace App\jwt;


final class JwtUtil
{
    public static function createJwt(): string
    {
        $jsonHeader = self::createProtectedHeaderJson();

        $protectedHeader = Base64Url::encode($jsonHeader);
        $payload = Base64Url::encode(self::createPayloadJson());
        $signature = Base64Url::encode(self::HMACed($protectedHeader . "." . $payload));
        return $protectedHeader . "." . $payload . "." . $signature;
    }

    private static function HMACed(string $data): string
    {
        return "";
    }

    private static function createProtectedHeaderJson(): string
    {
        return json_encode(["typ" => "JWT", "alg" => "HS256"], JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
    }

    private static function createPayloadJson(): string
    {
        return json_encode(["iss" => "joe", "exp" => 1300819380, "http://example.com/is_root" => true], JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}

?>