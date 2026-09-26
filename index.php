<?php
require_once 'config.php';
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrapoWalks | Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <nav class="nav container">
        <a class="logo" href="index.php">TrapoWalks</a>
        <ul class="nav-links">
            <li><a href="#hero">Home</a></li>
            <li><a href="#explore">Explore</a></li>
            <li><a href="features.php">Features</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if ($isLoggedIn): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
    <section id="hero" class="hero container fade-in">
        <div>
            <h1>Discover hidden city walks built by local explorers</h1>
            <p>TrapoWalks helps you track, filter, and save walking trails in creative neighborhoods.</p>
            <a class="btn" href="features.php">View Features</a>
        </div>
    </section>

    <section id="explore" class="container fade-in">
        <h2>Why walkers choose TrapoWalks</h2>
        <div class="card-grid">
            <article class="card">
                <h3>Curated Themes</h3>
                <p>Browse art routes, food alleys, and sunrise climbs with easy filtering.</p>
            </article>
            <article class="card">
                <h3>Progress Tracking</h3>
                <p>Track walks and build your own collection using a secure account dashboard.</p>
            </article>
            <article class="card">
                <h3>Community Contact</h3>
                <p>Send suggestions through the contact page and help us improve route quality.</p>
            </article>
        </div>
    </section>
</main>

<footer class="site-footer">
    <p>© <?php echo date('Y'); ?> TrapoWalks</p>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
