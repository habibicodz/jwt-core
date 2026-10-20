<?php

use App\jwt\JwtTest;
require __DIR__ . '/../bootstrap.php';

print_r(JwtTest::createJwt());
// print_r(hash_hmac_algos());

// if (AuthUtil::isAuthenticated()) {
//     header("Location: /user/dashboard.php");
//     exit;
// }

// $authenticated = null;
// $loginSubmitted = false;

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
//     $loginSubmitted = true;
//     $credentials = ["email" => $_POST["email"], "password" => $_POST["password"]];

//     $authenticated = AuthUtil::authenticate($credentials);
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | JWT Playground</title>

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

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .container {
            width: min(100%, 360px);
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 18px;
            padding: 28px;
            border: 1px solid #303030;
            border-radius: 8px;
            background: #191919;
        }

        h1 {
            margin: 0 0 2px;
            font-size: 1.4rem;
            font-weight: 600;
        }

        form .input-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        form .input {
            width: 100%;
            min-height: 42px;
            padding: 10px 12px;
            border: 1px solid #3a3a3a;
            border-radius: 6px;
            outline: none;
            background: #111;
            color: #eee;
            font: inherit;
            transition: border-color .15s ease;
        }

        form .input::placeholder {
            color: #777;
        }

        form .input:focus {
            border-color: #888;
        }

        form .input-label {
            color: #ccc;
            font-size: .875rem;
        }

        form .submit-btn {
            width: 100%;
            min-height: 42px;
            margin-top: 1px;
            padding: 10px 14px;
            border: 0;
            border-radius: 6px;
            background: #eee;
            color: #111;
            cursor: pointer;
            font: inherit;
            font-weight: 600;
            transition: background-color .15s ease;
        }

        form .submit-btn:hover {
            background: #d5d5d5;
        }

        form .submit-btn:focus-visible {
            outline: 2px solid #aaa;
            outline-offset: 2px;
        }

        .testing-note {
            margin: -5px 0 0;
            color: #888;
            font-size: .75rem;
            line-height: 1.4;
            text-align: center;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 24px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="login-form" class="form-container" method="POST" action="">
            <h1>Sign in</h1>

            <div class="input-group">
                <label class="input-label" for="email">Email</label>
                <input class="input" type="email" name="email" id="email" placeholder="you@example.com"
                    autocomplete="username" required>
            </div>

            <div class="input-group">
                <label class="input-label" for="password">Password</label>
                <input class="input" type="password" name="password" id="password" placeholder="Enter your password"
                    autocomplete="current-password" required>
            </div>

            <button class="submit-btn" type="submit" id="login-submit-btn">Sign in</button>
            <p class="testing-note">Testing site · The authentication result appears in a browser alert.</p>
        </form>
    </div>
    <?php if ($loginSubmitted): ?>
        <script>
            alert(<?= json_encode($authenticated ?? 'Authentication failed.', JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>);
        </script>
    <?php endif; ?>
</body>

</html>