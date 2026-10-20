<?php
namespace App\jwt;


final class JwtUtil
{
    public static function createJwt(): string
    {
        $protectedHeader = Base64Url::encode(self::createProtectedHeaderJson());
        $payload = Base64Url::encode(self::createPayloadJson());
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