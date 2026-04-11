<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';
include 'include/gamesBackend.php';

$model = new GameModel($conn);

$category = $_GET['category'] ?? null;
$rating = $_GET['rating'] ?? null;

$games = $model->getGames($category, $rating);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">
</head>

<body class="d-flex flex-column">

    <!-- Navigation -->
    <?php include 'include/navigationBar.php' ?>

    <div class="container-fluid px-4 mt-5">
        <div class="row">

            <!-- Filter Side Bar -->
            <div class="col-md-3">
                <form method="get" class="sidebar">
                    <h5 class="mb-3">Filter</h5>

                    <!-- Rating -->
                    <div class="mb-3">
                        <label class="form-label">Minimum Rating</label>
                        <select name="rating" class="form-select">
                            <option value="">Any</option>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                $selected = (isset($_GET['rating']) && $_GET['rating'] == $i) ? 'selected' : '';
                                echo "<option value='$i' $selected>" . str_repeat("⭐", $i) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="">Any</option>
                            <option value="Action">Action</option>
                            <option value="RPG">RPG</option>
                            <option value="FPS">FPS</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Horror">Horror</option>
                            <option value="Open World">Open World</option>
                            <option value="Racing">Racing</option>
                            <option value="Simulation">Simulation</option>
                            <option value="Sports">Sports</option>
                            <option value="Strategy">Strategy</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </form>
            </div>

            <!-- List of Games -->
            <div class="col-md-9">
                <div class="row">

                    <?php if ($games && $games->num_rows > 0): ?>

                        <?php while ($game = $games->fetch_assoc()): ?>
                            <div class="col-md-3 mb-4">
                                <div class="card h-100 shadow-sm">

                                    <a href="games.php?id=<?php echo $game['game_id']; ?>" class="text-decoration-none text-dark">

                                        <!-- Game Image -->
                                        <img src="<?php echo htmlspecialchars($game['cover_image']); ?>"
                                            class="img-fluid rounded-top">

                                        <!-- Game Info -->
                                        <div class="card-body">
                                            <h6 class="fw-bold">
                                                <?php echo htmlspecialchars($game['title']); ?>
                                            </h6>

                                            <!-- Release Date -->
                                            <p class="text-muted small mb-1">
                                                <?php echo date("F j, Y", strtotime($game['release_date'])); ?>
                                            </p>

                                            <!-- Rating -->
                                            <div class="mb-2">
                                                <div class="mb-2">
                                                    ⭐ <strong><?php echo number_format($game['avg_rating'] ?? 0, 1); ?></strong> / 5
                                                </div>
                                            </div>
                                        </div>

                                    </a>

                                </div>
                            </div>
                        <?php endwhile; ?>

                    <?php else: ?>
                        <p>No games found.</p>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include 'include/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>