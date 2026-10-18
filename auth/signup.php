<?php

use App\AuthUtil;

require "../vendor/autoload.php";

if (AuthUtil::isAuthenticated()) {
header("Location: /user/dashboard.php");    
exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css"> 
</head>
<body>
    <h1>This is a sign up page</h1>
</body>
</html>