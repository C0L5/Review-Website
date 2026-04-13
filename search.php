<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

$search = $_GET['searchbar'] ?? '';
$games = null;

if (!empty($search)) {
    $searchTerm = "%" . $search . "%";

    $stmt = $conn->prepare("
        SELECT *
        FROM games
        WHERE title LIKE ?
           OR developer LIKE ?
           OR publisher LIKE ?
           OR description LIKE ?
        ORDER BY title ASC
    ");

    $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $games = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">
</head>
<body class="d-flex flex-column">

<?php include 'include/navigationBar.php'; ?>

<div class="container my-5">
    <h2 class="mb-4">Search Results</h2>

    <?php if (empty($search)): ?>
        <p>Please type a game name to search.</p>

    <?php elseif ($games && $games->num_rows > 0): ?>
        <p class="mb-4">Showing results for: <strong><?php echo htmlspecialchars($search); ?></strong></p>

        <div class="row">
            <?php while ($game = $games->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <a href="games.php?id=<?php echo $game['game_id']; ?>" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm">
                            <img src="<?php echo htmlspecialchars($game['cover_image']); ?>"
                                 class="card-img-top"
                                 alt="<?php echo htmlspecialchars($game['title']); ?>"
                                 style="height: 350px; object-fit: cover;">

                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($game['title']); ?></h5>
                                <p class="card-text mb-1">
                                    <strong>Developer:</strong> <?php echo htmlspecialchars($game['developer']); ?>
                                </p>
                                <p class="card-text mb-1">
                                    <strong>Release:</strong> <?php echo htmlspecialchars($game['release_date']); ?>
                                </p>
                                <p class="card-text">
                                    <?php echo htmlspecialchars($game['description']); ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

    <?php else: ?>
        <p>No games found for <strong><?php echo htmlspecialchars($search); ?></strong>.</p>
    <?php endif; ?>
</div>

<?php include 'include/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>