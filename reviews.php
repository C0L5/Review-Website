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

$pageTitle = "Browse Games";
if (!empty($category) && !empty($rating)) {
    $pageTitle = $category . " Games • " . str_repeat("⭐", (int)$rating) . "+";
} elseif (!empty($category)) {
    $pageTitle = $category . " Games";
} elseif (!empty($rating)) {
    $pageTitle = str_repeat("⭐", (int)$rating) . "+ Rated Games";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">

    <style>
        .sidebarCard {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 18px;
            padding: 1.25rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        }

        .gamesHeader {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .gamesHeader h2 {
            margin: 0;
        }

        .resultBadge {
            background: rgba(255, 255, 255, 0.08);
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-size: 0.95rem;
        }

        .gameCardLink {
            text-decoration: none;
            color: inherit;
        }

        .gameCardLink:hover {
            color: inherit;
        }

        .gameCard {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            height: 100%;
        }

        .gameCard:hover {
            transform: translateY(-8px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.24);
        }

        .gameCard img {
            height: 300px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gameCard:hover img {
            transform: scale(1.04);
        }

        .gameMeta {
            font-size: 0.9rem;
            color: #bdbdbd;
        }

        .gameDescription {
            font-size: 0.92rem;
            color: #d0d0d0;
        }

        .emptyState {
            border-radius: 18px;
            padding: 2rem;
            text-align: center;
            background: rgba(255, 255, 255, 0.04);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        }
    </style>
</head>

<body class="d-flex flex-column">

    <?php include 'include/navigationBar.php' ?>

    <div class="container-fluid px-4 mt-5">
        <div class="row g-4">

            <!-- Filter Sidebar -->
            <div class="col-md-3">
                <div class="sidebarCard">
                    <form method="get" class="sidebar">
                        <h5 class="mb-3">Filter Games</h5>

                        <!-- Rating -->
                        <div class="mb-3">
                            <label class="form-label">Minimum Rating</label>
                            <select name="rating" class="form-select">
                                <option value="">Any</option>
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    $selected = (!empty($_GET['rating']) && $_GET['rating'] == $i) ? 'selected' : '';
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
                                <?php
                                $categories = ["Action", "RPG", "FPS", "Adventure", "Horror", "Open World", "Racing", "Simulation", "Sports", "Strategy"];
                                foreach ($categories as $cat) {
                                    $selected = (!empty($_GET['category']) && $_GET['category'] === $cat) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($cat) . "' $selected>" . htmlspecialchars($cat) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="reviews.php" class="btn btn-outline-light">Clear Filters</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Games List -->
            <div class="col-md-9">
                <div class="gamesHeader">
                    <div>
                        <h2><?php echo htmlspecialchars($pageTitle); ?></h2>
                        <p class="text-muted mb-0">
                            Explore a variety of games and open each one to see full details.
                        </p>
                    </div>

                    <?php if ($games): ?>
                        <div class="resultBadge">
                            <?php echo $games->num_rows; ?> result<?php echo $games->num_rows == 1 ? '' : 's'; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <?php if ($games && $games->num_rows > 0): ?>

                        <?php while ($game = $games->fetch_assoc()): ?>
                            <div class="col-md-4 col-lg-3 mb-4">
                                <a href="games.php?id=<?php echo $game['game_id']; ?>" class="gameCardLink">
                                    <div class="card gameCard shadow-sm">

                                        <img src="<?php echo htmlspecialchars($game['cover_image']); ?>"
                                            class="img-fluid"
                                            alt="<?php echo htmlspecialchars($game['title']); ?>">

                                        <div class="card-body">
                                            <h6 class="fw-bold mb-2">
                                                <?php echo htmlspecialchars($game['title']); ?>
                                            </h6>

                                            <p class="gameMeta mb-2">
                                                <?php echo date("F j, Y", strtotime($game['release_date'])); ?>
                                            </p>

                                            <div class="mb-2">
                                                ⭐ <strong><?php echo number_format($game['avg_rating'] ?? 0, 1); ?></strong> / 5
                                            </div>

                                            <?php if (!empty($game['description'])): ?>
                                                <p class="gameDescription mb-0">
                                                    <?php
                                                    $desc = $game['description'];
                                                    echo htmlspecialchars(strlen($desc) > 75 ? substr($desc, 0, 75) . '...' : $desc);
                                                    ?>
                                                </p>
                                            <?php else: ?>
                                                <p class="gameDescription mb-0">Click to view details.</p>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>

                    <?php else: ?>
                        <div class="col-12">
                            <div class="emptyState">
                                <h4 class="mb-3">No games found</h4>
                                <p class="text-muted mb-4">
                                    Try changing the category or rating filters to see more games.
                                </p>
                                <a href="reviews.php" class="btn btn-primary">Show All Games</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <?php include 'include/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>