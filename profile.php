<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT username, bio, favorite_genre, profile_picture FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
</head>


<body class="d-flex flex-column">
    <!-- Navigation Bar -->
    <?php include 'include/navigationBar.php' ?>

    <div class="container mt-5" style="max-width: 70vw;">
        <!-- Avatar & Username -->
        <div class="d-flex align-items-center mt-n5 px-3">
            <img 
                src="<?php echo !empty($user['profile_picture']) ? 'uploads/' . $user['profile_picture'] : 'images/default-avatar.png'; ?>" 
                class="rounded-circle border border-white" 
                style="height: 80px; width: 80px; object-fit:cover;"
            >

            <div class="ms-3 px-3">
                <h4><?php echo htmlspecialchars($user['username']); ?></h4>

                <p class="mb-0">
                    <?php echo !empty($user['bio']) ? htmlspecialchars($user['bio']) : 'No bio yet'; ?>
                </p>

                <p>
                    Genre: <?php echo !empty($user['favorite_genre']) ? htmlspecialchars($user['favorite_genre']) : 'Not set'; ?>
                </p>

                <small>27 Reviews</small>
            </div>
            <div class="ms-auto">
                <a href="editProfile.php" class="text-white">Edit Profile</a>
            </div>
        </div>
        <!-- Tabs -->
        <ul class="nav nav-tabs mt-3 mb-3">
            <li class="nav-item"><a class="nav-link active">Reviews</a></li>

        </ul>

        <!-- Reviews -->
        <?php
            $stmt = $conn->prepare("
                SELECT r.title, r.content, r.rating, g.title AS game_title
                FROM reviews r
                JOIN games g ON r.game_id = g.game_id
                WHERE r.user_id = ?
                ORDER BY r.created_at DESC
            ");
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $reviews = $stmt->get_result();
            ?>

            <?php while ($review = $reviews->fetch_assoc()): ?>
                <div class="card mb-3 p-3 d-flex flex-row">
                    <div>
                        <h5><?php echo htmlspecialchars($review['game_title']); ?></h5>
                        <strong><?php echo htmlspecialchars($review['title']); ?></strong>
                        <p>⭐ <?php echo $review['rating']; ?>/10</p>
                        <p><?php echo htmlspecialchars($review['content']); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>

    </div>

    <!--The footer-->
    <?php include 'include/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
</body>

</html>