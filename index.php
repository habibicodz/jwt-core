<?php
require './bootstrap.php';

use App\AuthUtil;

if (!AuthUtil::isAuthenticated()) {
    header("Location: /auth/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>This is just a simple dashboard</h1>
</body>
</html>