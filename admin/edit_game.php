<?php
include '../include/admin_only.php';
include '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: games.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM games WHERE game_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$game = $stmt->get_result()->fetch_assoc();

if (!$game) {
    die("Game not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_date = $_POST['release_date'];
    $developer = $_POST['developer'];
    $publisher = $_POST['publisher'];
    $cover_image = $_POST['cover_image'];
    $igdb_id = !empty($_POST['igdb_id']) ? (int)$_POST['igdb_id'] : null;

    $stmt = $conn->prepare("
        UPDATE games
        SET title = ?, description = ?, release_date = ?, developer = ?, publisher = ?, cover_image = ?, igdb_id = ?
        WHERE game_id = ?
    ");
    $stmt->bind_param("ssssssii", $title, $description, $release_date, $developer, $publisher, $cover_image, $igdb_id, $id);
    $stmt->execute();

    header("Location: games.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Game</title>
    <link rel="stylesheet" href="../css/master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../include/navigationBar.php'; ?>

    <div class="container my-5" style="max-width: 800px;">
        <h2 class="mb-4">Edit Game</h2>

        <form method="POST">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($game['title']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($game['description']); ?></textarea>
            </div>

            <div class="mb-3">
                <label>Release Date</label>
                <input type="date" name="release_date" class="form-control" value="<?php echo htmlspecialchars($game['release_date']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Developer</label>
                <input type="text" name="developer" class="form-control" value="<?php echo htmlspecialchars($game['developer']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Publisher</label>
                <input type="text" name="publisher" class="form-control" value="<?php echo htmlspecialchars($game['publisher']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Cover Image Path</label>
                <input type="text" name="cover_image" class="form-control" value="<?php echo htmlspecialchars($game['cover_image']); ?>" required>
            </div>

            <div class="mb-3">
                <label>IGDB ID</label>
                <input type="number" name="igdb_id" class="form-control" value="<?php echo htmlspecialchars($game['igdb_id']); ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update Game</button>
            <a href="dashboard.php" class="btn btn-outline-light">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>