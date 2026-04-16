<?php
include '../include/admin_only.php';
include '../db.php';

$reviews = $conn->query("
    SELECT r.review_id, r.title, r.rating, r.created_at, u.username, g.title AS game_title
    FROM reviews r
    JOIN users u ON r.user_id = u.user_id
    JOIN games g ON r.game_id = g.game_id
    ORDER BY r.created_at DESC
");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Manage Reviews</title>
    <link rel="stylesheet" href="../css/master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../include/navigationBar.php'; ?>

    <div class="container my-5">
        <h2 class="mb-4">Manage Reviews</h2>

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Game</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Rating</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($review = $reviews->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $review['review_id']; ?></td>
                        <td><?php echo htmlspecialchars($review['game_title']); ?></td>
                        <td><?php echo htmlspecialchars($review['username']); ?></td>
                        <td><?php echo htmlspecialchars($review['title']); ?></td>
                        <td><?php echo htmlspecialchars($review['rating']); ?></td>
                        <td><?php echo htmlspecialchars($review['created_at']); ?></td>
                        <td>
                            <a href="delete_review.php?id=<?php echo $review['review_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this review?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>