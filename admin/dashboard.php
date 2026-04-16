<?php
include '../include/admin_only.php';
include '../db.php';

$gameCount = $conn->query("SELECT COUNT(*) as total FROM games")->fetch_assoc()['total'];
$userCount = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$reviewCount = $conn->query("SELECT COUNT(*) as total FROM reviews")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../include/navigationBar.php'; ?>

    <div class="container my-5">
        <h2 class="mb-4">Admin Dashboard</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <h4><?php echo $gameCount; ?></h4>
                    <p class="mb-0">Games</p>
                    <a href="games.php" class="btn btn-primary mt-3">Manage Games</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <h4><?php echo $userCount; ?></h4>
                    <p class="mb-0">Users</p>
                    <a href="users.php" class="btn btn-primary mt-3">Manage Users</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <h4><?php echo $reviewCount; ?></h4>
                    <p class="mb-0">Reviews</p>
                    <a href="reviews.php" class="btn btn-primary mt-3">Manage Reviews</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>