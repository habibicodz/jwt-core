<?php

namespace App;

use App\database\DBUtil;


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Method not allowed");
}

$fullName = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];

$user = DBUtil::createUser($fullName, $username, $password);

if ($user) {
    header('Location: /auth/login.php');
    exit;
}


header('Location: /auth/signup.php');
exit;
?>