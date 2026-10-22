<?php

use App\jwt\JwtTest;
require './bootstrap.php';

print_r(JwtTest::createJwt());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        :root {
            color-scheme: dark;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #111;
            color: #eee;
        }

        * {
            box-sizing: border-box;
        }
    </style>
</head>

<body>

</body>

</html>