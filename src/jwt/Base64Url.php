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


    // Test vector for testing Encoding
    public static function testRfcHeaderEncoding()
    {
        // Reference: https://datatracker.ietf.org/doc/html/rfc7515#appendix-A.1
        $rfcHeaderBytes = "{\"typ\":\"JWT\"," . "\r\n" . " \"alg\":\"HS256\"}";
        $rfcHeaderBase64 = "eyJ0eXAiOiJKV1QiLA0KICJhbGciOiJIUzI1NiJ9";

        $encoded = self::encode($rfcHeaderBytes);

        // Assert base64url encoder produces the RFC's exact output:
        assert($encoded === $rfcHeaderBase64);

        // Assert the bytes match the RFC's octet list:
        assert(array_values(unpack("C*", $rfcHeaderBytes)) === [
            123,
            34,
            116,
            121,
            112,
            34,
            58,
            34,
            74,
            87,
            84,
            34,
            44,
            13,
            10,
            32,
            34,
            97,
            108,
            103,
            34,
            58,
            34,
            72,
            83,
            50,
            53,
            54,
            34,
            125,
        ]);
    }



    // Test vector for testing Encoding
    public static function testRfcPayloadEncoding()
    {
        // Reference: https://datatracker.ietf.org/doc/html/rfc7515#appendix-A.1
        $rfcPayloadBytes = "{\"iss\":\"joe\"," . "\r\n"
            . " \"exp\":1300819380," . "\r\n"
            . " \"http://example.com/is_root\":true}";

        $rfcPayloadBase64 = "eyJpc3MiOiJqb2UiLA0KICJleHAiOjEzMDA4MTkzODAsDQogImh0dHA6Ly9leGFtcGxlLmNvbS9pc19yb290Ijp0cnVlfQ";

        $encoded = self::encode($rfcPayloadBytes);

        // Assert base64url encoder produces the RFC's exact output:
        assert($encoded === $rfcPayloadBase64);

        // Assert the bytes match the RFC's octet list:
        assert(array_values(unpack("C*", $rfcPayloadBytes)) === [
            123,
            34,
            105,
            115,
            115,
            34,
            58,
            34,
            106,
            111,
            101,
            34,
            44,
            13,
            10,
            32,
            34,
            101,
            120,
            112,
            34,
            58,
            49,
            51,
            48,
            48,
            56,
            49,
            57,
            51,
            56,
            48,
            44,
            13,
            10,
            32,
            34,
            104,
            116,
            116,
            112,
            58,
            47,
            47,
            101,
            120,
            97,
            109,
            112,
            108,
            101,
            46,
            99,
            111,
            109,
            47,
            105,
            115,
            95,
            114,
            111,
            111,
            116,
            34,
            58,
            116,
            114,
            117,
            101,
            125
        ]);
    }
}
?>