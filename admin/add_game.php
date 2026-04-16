<?php
include '../include/admin_only.php';
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_date = $_POST['release_date'];
    $developer = $_POST['developer'];
    $publisher = $_POST['publisher'];
    $cover_image = $_POST['cover_image'];
    $igdb_id = !empty($_POST['igdb_id']) ? (int)$_POST['igdb_id'] : null;

    $stmt = $conn->prepare("
        INSERT INTO games (title, description, release_date, developer, publisher, cover_image, igdb_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssssssi", $title, $description, $release_date, $developer, $publisher, $cover_image, $igdb_id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Add Game</title>
    <link rel="stylesheet" href="../css/master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../include/navigationBar.php'; ?>

    <div class="container my-5" style="max-width: 800px;">
        <h2 class="mb-4">Add Game</h2>

        <form method="POST">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label>Release Date</label>
                <input type="date" name="release_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Developer</label>
                <input type="text" name="developer" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Publisher</label>
                <input type="text" name="publisher" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Cover Image Path</label>
                <input type="text" name="cover_image" class="form-control" placeholder="images/games/example.jpg" required>
            </div>

            <div class="mb-3">
                <label>IGDB ID</label>
                <input type="number" name="igdb_id" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Add Game</button>
            <a href="dashboard.php" class="btn btn-outline-light">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>