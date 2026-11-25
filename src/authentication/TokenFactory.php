<?php
namespace App\authentication;

use App\jwtcore\Base64Url;
use App\jwtcore\JwtGenerator;

final class TokenFactory
{
    private string $_key = "";

    public function __construct(string $key)
    {
        $this->_key = $key;
    }

    public function create_token($user): string
    {
        $now = time();

        $claims = [
            "sub" => (string) $user->id,
            "username" => $user->username,
            "iat" => $now,
            "exp" => $now + 3600
        ];

        $payloadJson = json_encode($claims, JSON_THROW_ON_ERROR);
        $token = new JwtGenerator($this->_key)->generate_token($payloadJson);
        return $token;
    }

    public function verify_token($token): bool
    {
        return new JwtGenerator($this->_key)->validateToken($token);
    }

    public function extract_claims($token): mixed
    {
        error_log("Token: $token");

        $payload = explode(".", $token)[1];
        error_log("payload: $payload");

        $payloaded_base64_decode = Base64Url::decode($payload);
        error_log("payloaded_base64_decode: $payloaded_base64_decode");
        return $payloaded_base64_decode;
    }
}
?>