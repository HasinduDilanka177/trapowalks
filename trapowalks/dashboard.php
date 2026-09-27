<?php
session_start();
require_once "includes/db.php";
require_once "includes/functions.php";
requireLogin();

$uid = $_SESSION['user_id'];
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_trip'])) {
    $destination = sanitize($_POST['destination']);
    $travel_date = $_POST['travel_date'];
    $notes       = sanitize($_POST['notes']);

    if (empty($destination) || empty($travel_date)) {
        $error = "Destination and travel date are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO trips (user_id, destination, travel_date, notes) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $uid, $destination, $travel_date, $notes);
        if ($stmt->execute()) {
            $success = "Trip added to your itinerary!";
        } else {
            $error = "Could not add trip.";
        }
        $stmt->close();
    }
}


if (isset($_GET['delete'])) {
    $trip_id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM trips WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $trip_id, $uid);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php");
    exit();
}


$stmt = $conn->prepare("SELECT * FROM trips WHERE user_id = ? ORDER BY travel_date ASC");
$stmt->bind_param("i", $uid);
$stmt->execute();
$trips = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | TrapoWalks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dashboard-body">

<nav class="navbar navbar-expand-lg navbar-dark" style="background:#0a192f">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.html"><i class="bi bi-compass text-brand"></i> Trapo<span class="text-brand">Walks</span></a>
        <div class="ms-auto d-flex align-items-center gap-2">
            <span class="text-white-50 small d-none d-sm-inline"><i class="bi bi-person-circle"></i> <?php echo sanitize($_SESSION['username']); ?></span>
            <a href="auth/logout.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="text-center mb-4 fade-in">
        <h2 class="fw-bold">Your Travel <span class="text-brand">Dashboard</span></h2>
        <p class="text-muted">Plan, track and relive every walk.</p>
    </div>

    <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert alert-success"><?php echo $success; ?></div><?php endif; ?>

    <div class="row g-4">
       
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 sticky-lg-top" style="top:20px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-plus-circle text-brand"></i> Add a Trip</h5>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Destination</label>
                            <input type="text" name="destination" class="form-control" placeholder="e.g. Ella" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Travel Date</label>
                            <input type="date" name="travel_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" rows="3" class="form-control" placeholder="Activities, guides, packing list..."></textarea>
                        </div>
                        <button type="submit" name="add_trip" class="btn btn-brand w-100">Save Trip</button>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="col-lg-8">
            <h5 class="fw-bold mb-3"><i class="bi bi-calendar-check text-brand"></i> My Itinerary</h5>
            <?php if ($trips->num_rows === 0): ?>
                <div class="alert alert-light border text-center text-muted">
                    No trips yet. Add your first adventure using the form!
                </div>
            <?php else: ?>
                <div class="row g-3">
                    <?php while ($trip = $trips->fetch_assoc()): ?>
                        <div class="col-md-6">
                            <div class="card trip-card shadow-sm border-0 h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h6 class="fw-bold mb-1"><?php echo sanitize($trip['destination']); ?></h6>
                                        <a href="dashboard.php?delete=<?php echo $trip['id']; ?>"
                                           class="text-danger"
                                           onclick="return confirm('Remove this trip?');">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                    <p class="small text-muted mb-1">
                                        <i class="bi bi-calendar3"></i> <?php echo $trip['travel_date']; ?>
                                    </p>
                                    <?php if (!empty($trip['notes'])): ?>
                                        <p class="small mb-0"><?php echo nl2br(sanitize($trip['notes'])); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
