<?php
$activeMenu = "login";
$pageTitle = "Login";

$token_cookie = $_COOKIE['token'] ?? null;
if ($token_cookie !== null && $tokenFactory->verify_token($token_cookie)) {
    header('Location: /user/dashboard.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>

    <link rel="stylesheet" href="../assets/App.css">
    <style>
        main {
            width: 100%;
            height: max-content;
            max-width: 960px;
            display: flex;
            margin: 0 auto;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 32px;
            flex: 1;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font: inherit;
            font-weight: 600;
            transition: background-color .15s ease;
        }

        .btn-primary {
            background: #eee;
            color: #111;
        }

        .btn-primary:hover {
            background: #d5d5d5;
        }

        .btn-outline {
            border: 1px solid #3a3a3a;
            color: #eee;
        }

        .btn-outline:hover {
            border-color: #888;
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
    </style>
</head>

<body>
    <?php require("../components/header.php"); ?>

    <main>
        <div class="container">
            <form id="login-form" class="form-container" method="POST" action="login.post.php">
                <h1>Login</h1>

                <div class="input-group">
                    <label class="input-label" for="username">Username</label>
                    <input class="input" type="username" name="username" id="email" placeholder="username"
                        autocomplete="username" required>
                </div>

                <div class="input-group">
                    <label class="input-label" for="password">Password</label>
                    <input class="input" type="password" name="password" id="password" placeholder="Enter your password"
                        autocomplete="current-password" required>
                </div>

                <button class="submit-btn" type="submit" id="login-submit-btn">Login</button>
            </form>
        </div>
    </main>

    <?php require("../components/footer.php"); ?>
</body>

</html>