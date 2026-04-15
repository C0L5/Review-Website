<?php
include '../include/admin_only.php';
include '../db.php';

$games = $conn->query("SELECT * FROM games ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Games</title>
    <link rel="stylesheet" href="../css/master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../include/navigationBar.php'; ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Games</h2>
        <a href="add_game.php" class="btn btn-success">Add Game</a>
    </div>

    <table class="table table-dark table-striped align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cover</th>
                <th>Title</th>
                <th>Developer</th>
                <th>Release Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($game = $games->fetch_assoc()): ?>
            <tr>
                <td><?php echo $game['game_id']; ?></td>
                <td><img src="../<?php echo htmlspecialchars($game['cover_image']); ?>" style="width:60px; height:80px; object-fit:cover;"></td>
                <td><?php echo htmlspecialchars($game['title']); ?></td>
                <td><?php echo htmlspecialchars($game['developer']); ?></td>
                <td><?php echo htmlspecialchars($game['release_date']); ?></td>
                <td>
                    <a href="edit_game.php?id=<?php echo $game['game_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="delete_game.php?id=<?php echo $game['game_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this game?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>