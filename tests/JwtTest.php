<?php


namespace Test;

use App\jwtcore\Base64Url;


class JwtTest
{
    public static function createJwt(): string
    {
        $protectedHeader = Base64Url::encode(self::createHeader());
        $payload = Base64Url::encode(self::createPayload());
        $signature = Base64Url::encode(self::HMACed($protectedHeader . "." . $payload, self::createTestKey()));
        return $protectedHeader . "." . $payload . "." . $signature;
    }

    private static function HMACed(string $data, $key): string
    {
        return hash_hmac("sha256", $data, $key, true);
    }

    private static function createTestKey(): string
    {
        $jwk = [
            "kty" => "oct",
            "k" => "AyM1SysPpbyDfgZld3umj1qzKObwVMkoqQ-EstJQLr_T-1qS0gZH75aKtMN3Yj0iPS4hcgUuTwjAzZr1Z9CAow"
        ];

        return Base64Url::decode($jwk["k"]);
    }

    private static function createHeader(): string
    {
        // {"typ":"JWT",\r\n "alg":"HS256"}
        return "{\"typ\":\"JWT\",\r\n \"alg\":\"HS256\"}";
    }

    private static function createPayload(): string
    {
        // {"iss":"joe",\r\n "exp":1300819380,\r\n "http://example.com/is_root":true}
        return "{\"iss\":\"joe\",\r\n \"exp\":1300819380,\r\n \"http://example.com/is_root\":true}";
    }
}

?>