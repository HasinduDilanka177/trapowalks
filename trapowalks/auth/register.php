<?php
session_start();
require_once "../includes/db.php";
require_once "../includes/functions.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize($_POST['username']);
    $email    = sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

   
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email or username is already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hash);
            if ($stmt->execute()) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | TrapoWalks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="auth-body">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card auth-card shadow-lg fade-in">
            <div class="card-body p-4 p-md-5">
                <h3 class="text-center fw-bold mb-1">Join <span class="text-brand">TrapoWalks</span></h3>
                <p class="text-center text-muted mb-4">Create your account and start exploring</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <form method="POST" action="" id="registerForm" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="e.g. nimal_travels" required>
                        <small class="text-danger d-none" id="usernameErr">Username must be at least 3 characters.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" required>
                        <small class="text-danger d-none" id="emailErr">Please enter a valid email address.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Min. 6 characters" required>
                        <small class="text-danger d-none" id="passwordErr">Password must be at least 6 characters.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirmPassword" class="form-control" required>
                        <small class="text-danger d-none" id="confirmErr">Passwords do not match.</small>
                    </div>
                    <button type="submit" class="btn btn-brand w-100 py-2">Create Account</button>
                </form>

                <p class="text-center mt-3 mb-0">Already have an account?
                    <a href="login.php" class="text-brand fw-semibold">Login here</a>
                </p>
                <p class="text-center mt-2"><a href="../index.html" class="text-muted small">&larr; Back to Home</a></p>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
</body>
</html>
