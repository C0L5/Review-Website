<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';
include 'include/gamesBackend.php';

$model = new GameModel($conn);

$gameId = $_GET['id'] ?? null;
if (!$gameId) {
    header("Location: index.php");
    exit();
}

$game = $model->getGameById($gameId);
if (!$game) {
    die("Game not found");
}

$reviews = $model->getReviews($gameId);
$avgRating = $model->getAverageRating($gameId);
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

                <p class="text-light mb-1">
                    By <strong><?php echo htmlspecialchars($game['developer']); ?></strong>
                </p>

                <div class="mb-2">
                    <?php
                    $rating = number_format($avgRating, 1);
                    ?>
                    <div class="mb-2">
                        ⭐ <strong><?php echo $rating; ?></strong> / 5
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

                        <p class="mt-2 mb-1">⭐ <?php echo $r['rating']; ?> / 5</p>

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

                <input type="hidden" name="game_id" value="<?php echo $gameId; ?>">

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Rating</label>
                    <select name="rating" class="form-control" required>
                        <option value="">Select rating</option>
                        <option value="1">1 ⭐</option>
                        <option value="2">2 ⭐⭐</option>
                        <option value="3">3 ⭐⭐⭐</option>
                        <option value="4">4 ⭐⭐⭐⭐</option>
                        <option value="5">5 ⭐⭐⭐⭐⭐</option>
                    </select>
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
                <a class="text-light" href="login.php">Login</a> to write a review.
            </p>
        <?php endif; ?>

    </div>

    <?php include 'include/footer.php' ?>

</body>

</html>

</html>