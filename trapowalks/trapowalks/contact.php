<?php
session_start();
require_once "includes/db.php";
require_once "includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = sanitize($_POST['name']);
    $email   = sanitize($_POST['email']);
    $message = sanitize($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['contact_error'] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['contact_error'] = "Please enter a valid email address.";
    } elseif (strlen($message) < 10) {
        $_SESSION['contact_error'] = "Message must be at least 10 characters.";
    } else {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        if ($stmt->execute()) {
            $_SESSION['contact_success'] = "Thank you! Your message has been received.";
        } else {
            $_SESSION['contact_error'] = "Failed to send message. Please try again.";
        }
        $stmt->close();
    }
}
redirect("index.php#contact");
?>
