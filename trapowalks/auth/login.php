<?php
session_start();
require_once "../includes/db.php";
require_once "../includes/functions.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = sanitize($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Both fields are required.";
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                redirect("../dashboard.php");
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
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
    <title>Login | TrapoWalks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="auth-body">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card auth-card shadow-lg fade-in">
            <div class="card-body p-4 p-md-5">
                <h3 class="text-center fw-bold mb-1">Welcome <span class="text-brand">Back</span></h3>
                <p class="text-center text-muted mb-4">Login to continue your journey</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="" id="loginForm" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="loginEmail" class="form-control" placeholder="you@example.com" required>
                        <small class="text-danger d-none" id="loginEmailErr">Please enter a valid email.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Your password" required>
                    </div>
                    <button type="submit" class="btn btn-brand w-100 py-2">Login</button>
                </form>

                <p class="text-center mt-3 mb-0">New to TrapoWalks?
                    <a href="register.php" class="text-brand fw-semibold">Create an account</a>
                </p>
                <p class="text-center mt-2"><a href="../index.html" class="text-muted small">&larr; Back to Home</a></p>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
</body>
</html>
