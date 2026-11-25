<?php

namespace App\jwtcore;

use App\jwtcore\Base64Url;

final class JwtGenerator
{
    private string $_key;

    public function __construct($key)
    {
        $this->_key = $key;
    }

    // Generate tokens
    public function generate_token(string $payload)
    {
        //Header
        $header = Base64Url::encode(json_encode(["typ" => "JWT", "alg" => "HS256"]));

        //Payload
        $payload = Base64Url::encode($payload);

        //Signature
        $signature = $this->create_signature("$header.$payload");
        $signature = Base64Url::encode($signature);

        // header.payload.signature
        return "$header.$payload.$signature";
    }

    // Validate tokens
    public function validateToken(string $token): bool
    {
        $parts = explode(".", $token);

        $header = $parts[0];

        $payload = $parts[1];

        $signature = $parts[2];

        $generated_signature = $this->create_signature("$header.$payload");

        return strcmp($generated_signature, $signature);
    }

    // Create signature from header.payload
    private function create_signature($data): string
    {
        return hash_hmac(algo: 'sha256', data: $data, key: $this->_key, binary: false);
    }

}
?>