<?php
namespace App;

session_start();

use App\utils\DBUtil;

require('../bootstrap.php');

$username = $_POST['username'];
$password = $_POST['password'];

$result = DBUtil::verifyUser($username, $password);
if (!$result && !isset($result->username)) {
    header('Location: /auth/login.php');
    exit;
} else {
    header('Location: /user/index.php');
    $_SESSION['userid'] = $result->id;
    exit;
}
?>