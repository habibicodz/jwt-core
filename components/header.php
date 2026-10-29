<?php
$pageTitle ??= "Home";
$activeMenu ??= "home";


?>

<header class="navbar">
    <a class="brand" href="/index.php">JWT<span>Playground</span></a>
    <nav class="nav-links">
        <a href="/index.php" class="<?= ($activeMenu == 'home') ? 'active' : '' ?>">Home</a>
        <a href="/auth/signup.php" class="<?= ($activeMenu == 'signup') ? 'active' : '' ?>">Signup</a>
        <a href="/auth/login.php" class="<?= ($activeMenu == 'login') ? 'active' : '' ?>">Login</a>
        <a href="/contact.php" class="<?= ($activeMenu == 'contact') ? 'active' : '' ?>">Contact</a>
    </nav>
</header>