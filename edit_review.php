<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$reviewId = $_GET['id'] ?? null;
$gameId = $_GET['game_id'] ?? null;

if (!$reviewId || !$gameId) {
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("
    SELECT review_id, user_id, game_id, title, rating, content
    FROM reviews
    WHERE review_id = ?
");
$stmt->bind_param("i", $reviewId);
$stmt->execute();
$review = $stmt->get_result()->fetch_assoc();

if (!$review) {
    die("Review not found.");
}

if ($review['user_id'] != $_SESSION['user_id']) {
    die("You are not allowed to edit this review.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Review</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">
</head>
<body class="d-flex flex-column">

<?php include 'include/navigationBar.php'; ?>

<div class="container my-5" style="max-width: 700px;">
    <h3 class="mb-4">Edit Review</h3>

    <form action="update_review.php" method="POST">
        <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
        <input type="hidden" name="game_id" value="<?php echo $review['game_id']; ?>">

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control"
                   value="<?php echo htmlspecialchars($review['title']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <select name="rating" class="form-control" required>
                <option value="1" <?php echo $review['rating'] == 1 ? 'selected' : ''; ?>>1 ⭐</option>
                <option value="2" <?php echo $review['rating'] == 2 ? 'selected' : ''; ?>>2 ⭐⭐</option>
                <option value="3" <?php echo $review['rating'] == 3 ? 'selected' : ''; ?>>3 ⭐⭐⭐</option>
                <option value="4" <?php echo $review['rating'] == 4 ? 'selected' : ''; ?>>4 ⭐⭐⭐⭐</option>
                <option value="5" <?php echo $review['rating'] == 5 ? 'selected' : ''; ?>>5 ⭐⭐⭐⭐⭐</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Comment</label>
            <textarea name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($review['content']); ?></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update Review</button>
            <a href="games.php?id=<?php echo $review['game_id']; ?>" class="btn btn-outline-light">Cancel</a>
        </div>
    </form>
</div>

<?php include 'include/footer.php'; ?>

</body>
</html>