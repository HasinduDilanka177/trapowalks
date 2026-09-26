<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'] ?? 'Walker';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrapoWalks | Dashboard</title>
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main class="container">
    <section class="fade-in">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Your account is active. Start exploring routes and planning your next themed walk.</p>
    </section>
</main>

<footer class="site-footer">
    <p>© <?php echo date('Y'); ?> TrapoWalks</p>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
