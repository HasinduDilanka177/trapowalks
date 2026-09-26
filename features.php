<?php
require_once 'config.php';
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrapoWalks | Features</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <nav class="nav container">
        <a class="logo" href="index.php">TrapoWalks</a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
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

<main class="container">
    <section class="fade-in">
        <h1>Interactive Features</h1>
        <p>Filter routes and preview themed spots with our image slider.</p>
    </section>

    <section class="slider fade-in" aria-label="Walk destination slider">
        <button class="btn-outline" type="button" data-slider-prev>Prev</button>
        <div class="slides" data-slider>
            <img src="assets/images/walk-1.svg" alt="Colorful market walk">
            <img src="assets/images/walk-2.svg" alt="Riverside sunrise path">
            <img src="assets/images/walk-3.svg" alt="Street art night tour">
        </div>
        <button class="btn-outline" type="button" data-slider-next>Next</button>
    </section>

    <section class="fade-in">
        <h2>Filter Walks by Difficulty</h2>
        <div class="filter-controls">
            <button type="button" class="btn-outline" data-filter="all">All</button>
            <button type="button" class="btn-outline" data-filter="easy">Easy</button>
            <button type="button" class="btn-outline" data-filter="medium">Medium</button>
            <button type="button" class="btn-outline" data-filter="hard">Hard</button>
        </div>
        <div class="card-grid" data-filter-container>
            <article class="card" data-level="easy">
                <h3>Lakeside Loop</h3>
                <p>Flat loop ideal for a peaceful morning.</p>
            </article>
            <article class="card" data-level="medium">
                <h3>Historic Core Trail</h3>
                <p>Old streets with moderate climbs and stairways.</p>
            </article>
            <article class="card" data-level="hard">
                <h3>Hilltop Lantern Walk</h3>
                <p>Steep route ending with panoramic city views.</p>
            </article>
        </div>
    </section>

    <section class="fade-in">
        <button type="button" class="btn" data-toggle-target="walkTips">Toggle Walking Tips</button>
        <div id="walkTips" class="tips-box">
            <ul>
                <li>Carry water and a light rain jacket.</li>
                <li>Choose shoes with firm grip for stone streets.</li>
                <li>Save your route screenshots before departure.</li>
            </ul>
        </div>
    </section>
</main>

<footer class="site-footer">
    <p>© <?php echo date('Y'); ?> TrapoWalks</p>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
