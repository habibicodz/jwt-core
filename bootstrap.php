<?php
namespace App;

use App\authentication\AuthUtil;
use App\authentication\TokenFactory;
use RuntimeException;

require __DIR__ . '/vendor/autoload.php';

// .env configuration without a dedicated library
$env_file_path = __DIR__ . "/.env";
if (!is_file($env_file_path)) {
    throw new RuntimeException(".env file not found");
}

$env = [];
foreach (file($env_file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $lines) {
    if ($lines == '' || $lines[0] == "#")
        continue;

    [$k, $v] = explode("=", $lines, 2);

    $env[$k] = $v;
}

//  ----------- KEY -----------
$ENV_KEY = "JWT_HS256_KEY";
$encoded_key = $env[$ENV_KEY] ?? '';

$key = hex2bin($encoded_key);
if ($key === false || strlen($key) !== 32) {
    throw new RuntimeException("$ENV_KEY must be 64hex chars (32 bytes)");
}

$tokenFactory = new TokenFactory($key);
?>