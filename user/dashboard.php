<?php

$token_cookie = $_COOKIE['token'] ?? null;
if ($token_cookie === null) {
    error_log("Cookie not exist");
    header('Location: /auth/login.php');
    exit;
}

$verified = $tokenFactory->verify_token($token_cookie);
if (!$verified) {
    error_log("Not verified");
    header('Location: /auth/login.php');
    exit;
}

$claims = $tokenFactory->extract_claims($token_cookie);

$username = json_decode($claims, associative: true)['username'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Welcome <?= $username ?></h1>
</body>

</html>