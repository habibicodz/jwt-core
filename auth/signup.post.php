<?php

namespace App;

use App\utils\DBUtil;

require '../bootstrap.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Method not allowed");
}

$fullName = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];

$result = DBUtil::createUser($fullName, $username, $password);

if ($result) {
    header('Location: /auth/login.php');
    exit;
} else {
    header('Location: /auth/signup.php');
    exit;
}
?>