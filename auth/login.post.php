<?php
namespace App;

use App\database\DBUtil;

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$user = DBUtil::verifyUser($username, $password);

// If user is verified
// generate and set token in header
if ($user === false) {
    header('Location: /auth/login.php');
    exit;
}

$token = $tokenFactory->create_token($user);
setcookie('token', $token, [
    'expires' => time() + 3600,
    'path' => '/'
]);

header('Location: /user/dashboard.php');
exit;
?>