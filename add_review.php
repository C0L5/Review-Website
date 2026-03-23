<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$games = $conn->query("SELECT game_id, title FROM games");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h2>Add Review</h2>

<form action="save_review.php" method="POST">

    <div class="mb-3">
        <label>Game</label>
        <select name="game_id" class="form-control" required>
            <option value="">Select a game</option>
            <?php while ($g = $games->fetch_assoc()): ?>
                <option value="<?php echo $g['game_id']; ?>">
                    <?php echo htmlspecialchars($g['title']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Review Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Rating (0–10)</label>
        <input type="number" name="rating" min="0" max="10" step="0.1" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Review</label>
        <textarea name="content" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-success">Submit Review</button>
</form>

</body>
</html>