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

$pageTitle = "Dashboard | JWT Testing";
$activeMenu = "dashboard";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <style>
        .hero {
            margin-top: 64px;
            padding: 32px;
            border: 1px solid #303030;
            border-radius: 8px;
            background: #191919;
        }

        .hero h1 {
            margin: 0 0 10px;
            font-size: clamp(1.6rem, 4vw, 2.4rem);
            font-weight: 700;
            line-height: 1.2;
        }

        .hero p {
            margin: 0;
            max-width: 60ch;
            color: #aaa;
            font-size: 1rem;
            line-height: 1.6;
        }

        .hero-actions {
            margin-top: 22px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
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

        @media (max-width: 480px) {
            .hero {
                margin-top: 40px;
                padding: 24px 20px;
            }
        }
    </style>

    <link rel="stylesheet" href="../assets/App.css">
</head>

<body>
    <?php require("../components/header.php"); ?>

    <main>
        <section class="hero">
            <h1>Welcome, <?= htmlspecialchars((string) $username, ENT_QUOTES, 'UTF-8') ?></h1>
            <p>This page is visible because the token in your cookie passed verification. Open the tasks page to see the
                demo content.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="index.php">View tasks</a>
            </div>
        </section>
    </main>

    <?php require("../components/footer.php") ?>
</body>

</html>