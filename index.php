<?php
$pageTitle = "Welcome | JWT Testing";
$activeMenu = "home";
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

        .btn-outline {
            border: 1px solid #3a3a3a;
            color: #eee;
        }

        .btn-outline:hover {
            border-color: #888;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
        }

        .card {
            padding: 22px;
            border: 1px solid #303030;
            border-radius: 8px;
            background: #191919;
        }

        .card h2 {
            margin: 0 0 8px;
            font-size: 1.05rem;
            font-weight: 600;
        }

        .card p {
            margin: 0;
            color: #999;
            font-size: .9rem;
            line-height: 1.5;
        }

        .card a {
            display: inline-block;
            margin-top: 12px;
            color: #8ab4ff;
            font-size: .875rem;
            text-decoration: none;
        }

        .card a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .hero {
                margin-top: 40px;
                padding: 24px 20px;
            }
        }
    </style>

    <link rel="stylesheet" href="assets/App.css">
</head>

<body>
    <?php require("components/header.php"); ?>

    <main>
        <section class="hero">
            <h1>Welcome to JWT Implementation</h1>
            <p>A small playground for learning how JSON Web Tokens work — issuing, signing, and
                verifying tokens to authenticate users in a PHP application.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="auth/signup.php">Get started</a>
                <a class="btn btn-outline" href="auth/login.php">Sign in</a>
            </div>
        </section>

        <section class="cards">
            <article class="card">
                <h2>Sign up</h2>
                <p>Create your account to get a user profile that tokens can be issued for.</p>
                <a href="auth/signup.php">Create account →</a>
            </article>
            <article class="card">
                <h2>Log in</h2>
                <p>Authenticate with your credentials and receive a signed JWT on success.</p>
                <a href="auth/login.php">Sign in →</a>
            </article>
            <article class="card">
                <h2>Dashboard</h2>
                <p>Once logged in, see the token in action on your protected dashboard.</p>
                <a href="user/dashboard.php">Open dashboard →</a>
            </article>
        </section>
    </main>

    <?php require("components/footer.php") ?>
</body>

</html>