<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$game_id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM games WHERE game_id = ?");
$stmt->bind_param("i", $game_id);
$stmt->execute();
$game = $stmt->get_result()->fetch_assoc();

if (!$game) {
    echo "Game not found";
    exit();
}

$stmt = $conn->prepare("
    SELECT r.*, u.username 
    FROM reviews r
    JOIN users u ON r.user_id = u.user_id
    WHERE r.game_id = ?
    ORDER BY r.created_at DESC
");
$stmt->bind_param("i", $game_id);
$stmt->execute();
$reviews = $stmt->get_result();

$stmt = $conn->prepare("
    SELECT AVG(rating) as avg_rating 
    FROM reviews 
    WHERE game_id = ?
");
$stmt->bind_param("i", $game_id);
$stmt->execute();
$avg = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($game['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">
</head>

<body class="d-flex flex-column">

<?php include 'include/navigationBar.php' ?>

<div class="container my-5">

    <!-- GAME HEADER -->
    <div class="row g-4">
        <div class="col-md-4">
            <img src="<?php echo htmlspecialchars($game['cover_image']); ?>"
                class="img-fluid rounded shadow-sm">
        </div>

        <div class="col-md-8">
            <h2><?php echo htmlspecialchars($game['title']); ?></h2>

            <p class="text-muted mb-1">
                By <strong><?php echo htmlspecialchars($game['developer']); ?></strong>
            </p>

            <div class="mb-2">
                 <?php
                $rating = number_format($avg['avg_rating'] ?? 0, 1);
                ?>
                <div class="mb-2">
                    ⭐ <strong><?php echo $rating; ?></strong> / 10
                </div> 
            </div>

            <p>
                <?php echo htmlspecialchars($game['description']); ?>
            </p>
        </div>
    </div>

    <hr class="my-5">

    <!-- REVIEWS -->
    <h4>Reviews</h4>

    <?php if ($reviews->num_rows > 0): ?>
        <?php while ($r = $reviews->fetch_assoc()): ?>
            <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0"><?php echo htmlspecialchars($r['username']); ?></h6>
                    <small class="text-muted">
                        <?php echo date("d M Y", strtotime($r['created_at'])); ?>
                    </small>
                </div>

                <p class="mt-2 mb-1">⭐ <?php echo $r['rating']; ?>/10</p>

                <strong><?php echo htmlspecialchars($r['title']); ?></strong>

                <p class="mb-0">
                    <?php echo htmlspecialchars($r['content']); ?>
                </p>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No reviews yet. Be the first!</p>
    <?php endif; ?>

    <hr class="my-5">

    <!-- ADD REVIEW -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <h5>Add a Review</h5>

        <form action="save_review.php" method="POST">

            <input type="hidden" name="game_id" value="<?php echo $game_id; ?>">

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Rating (0–10)</label>
                <input type="number" name="rating" min="0" max="10" step="0.1" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Comment</label>
                <textarea name="content" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Submit Review
            </button>
        </form>

    <?php else: ?>
        <p>
            <a href="login.php">Login</a> to write a review.
        </p>
    <?php endif; ?>

</div>

<?php include 'include/footer.php' ?>

</body>
</html>

</html>