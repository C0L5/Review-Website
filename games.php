<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';
include 'include/gamesBackend.php';
include 'include/igdbHelper.php';

$model = new GameModel($conn);

$gameId = $_GET['id'] ?? null;
$source = $_GET['source'] ?? 'db';

if (!$gameId) {
    header("Location: index.php");
    exit();
}

$reviews = null;
$avgRating = 0;
$game = null;
$isUpcomingApiGame = false;

$igdb = new IgdbApi();

if ($source === 'api') {
    $apiGame = $igdb->getGameById($gameId);

    if (!$apiGame) {
        die("Game not found");
    }

    $developer = 'Unknown';
    $publisher = 'Unknown';

    if (!empty($apiGame['involved_companies'])) {
        foreach ($apiGame['involved_companies'] as $companyData) {
            if (!empty($companyData['developer']) && !empty($companyData['company']['name']) && $developer === 'Unknown') {
                $developer = $companyData['company']['name'];
            }

            if (!empty($companyData['publisher']) && !empty($companyData['company']['name']) && $publisher === 'Unknown') {
                $publisher = $companyData['company']['name'];
            }
        }
    }

    $platforms = [];
    if (!empty($apiGame['platforms'])) {
        foreach ($apiGame['platforms'] as $platform) {
            if (!empty($platform['name'])) {
                $platforms[] = $platform['name'];
            }
        }
    }

    $genres = [];
    if (!empty($apiGame['genres'])) {
        foreach ($apiGame['genres'] as $genre) {
            if (!empty($genre['name'])) {
                $genres[] = $genre['name'];
            }
        }
    }

    $screenshots = [];
    if (!empty($apiGame['screenshots'])) {
        foreach ($apiGame['screenshots'] as $shot) {
            if (!empty($shot['url'])) {
                $screenshots[] = 'https:' . str_replace('t_thumb', 't_screenshot_big', $shot['url']);
            }
        }
    }

    $releaseTimestamp = $apiGame['first_release_date'] ?? null;
    $releaseDate = $releaseTimestamp ? date('d M Y', $releaseTimestamp) : 'TBA';
    $isUpcomingApiGame = !$releaseTimestamp || $releaseTimestamp > time();

    $game = [
        'title' => $apiGame['name'] ?? 'Untitled',
        'cover_image' => !empty($apiGame['cover']['url'])
            ? 'https:' . str_replace('t_thumb', 't_cover_big', $apiGame['cover']['url'])
            : '',
        'developer' => $developer,
        'publisher' => $publisher,
        'description' => !empty($apiGame['summary']) ? $apiGame['summary'] : 'No description available.',
        'storyline' => $apiGame['storyline'] ?? '',
        'release_date' => $releaseDate,
        'platforms' => $platforms,
        'genres' => $genres,
        'screenshots' => $screenshots
    ];
} else {
    $dbGame = $model->getGameById($gameId);

    if (!$dbGame) {
        die("Game not found");
    }

    $loggedUserId = $_SESSION['user_id'] ?? 0;
    $reviews = $model->getReviews($gameId, $loggedUserId);
    $avgRating = $model->getAverageRating($gameId);

    $apiGame = null;
    if (!empty($dbGame['igdb_id'])) {
        $apiGame = $igdb->getGameById($dbGame['igdb_id']);
    }

    $developer = !empty($dbGame['developer']) ? $dbGame['developer'] : 'Unknown';
    $publisher = !empty($dbGame['publisher']) ? $dbGame['publisher'] : 'Unknown';
    $releaseDate = !empty($dbGame['release_date'])
        ? date('d M Y', strtotime($dbGame['release_date']))
        : 'TBA';

    $description = !empty($dbGame['description']) ? $dbGame['description'] : 'No description available.';
    $storyline = !empty($dbGame['storyline']) ? $dbGame['storyline'] : '';
    $platforms = [];
    $genres = [];
    $screenshots = [];

    if ($apiGame) {
        if (!empty($apiGame['involved_companies'])) {
            foreach ($apiGame['involved_companies'] as $companyData) {
                if (!empty($companyData['developer']) && !empty($companyData['company']['name'])) {
                    $developer = $companyData['company']['name'];
                    break;
                }
            }

            foreach ($apiGame['involved_companies'] as $companyData) {
                if (!empty($companyData['publisher']) && !empty($companyData['company']['name'])) {
                    $publisher = $companyData['company']['name'];
                    break;
                }
            }
        }

        if (!empty($apiGame['first_release_date'])) {
            $releaseDate = date('d M Y', $apiGame['first_release_date']);
        }

        if (!empty($apiGame['summary'])) {
            $description = $apiGame['summary'];
        }

        if (!empty($apiGame['storyline'])) {
            $storyline = $apiGame['storyline'];
        }

        if (!empty($apiGame['platforms'])) {
            foreach ($apiGame['platforms'] as $platform) {
                if (!empty($platform['name'])) {
                    $platforms[] = $platform['name'];
                }
            }
        }

        if (!empty($apiGame['genres'])) {
            foreach ($apiGame['genres'] as $genre) {
                if (!empty($genre['name'])) {
                    $genres[] = $genre['name'];
                }
            }
        }

        if (!empty($apiGame['screenshots'])) {
            foreach ($apiGame['screenshots'] as $shot) {
                if (!empty($shot['url'])) {
                    $screenshots[] = 'https:' . str_replace('t_thumb', 't_screenshot_big', $shot['url']);
                }
            }
        }
    }

    $game = [
        'title' => !empty($dbGame['title']) ? $dbGame['title'] : ($apiGame['name'] ?? 'Untitled'),
        'cover_image' => !empty($apiGame['cover']['url'] ?? null) ? 'https:' . str_replace('t_thumb', 't_cover_big', $apiGame['cover']['url']) : (!empty($dbGame['cover_image']) ? $dbGame['cover_image'] : ''),
        'developer' => $developer,
        'publisher' => $publisher,
        'description' => $description,
        'storyline' => $storyline,
        'release_date' => $releaseDate,
        'platforms' => $platforms,
        'genres' => $genres,
        'screenshots' => $screenshots
    ];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($game['title']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">
</head>

<body class="d-flex flex-column">

    <?php include 'include/navigationBar.php' ?>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <?php if (!empty($game['cover_image'])): ?>
                    <img src="<?php echo htmlspecialchars($game['cover_image']); ?>" class="img-fluid rounded shadow-sm" alt="<?php echo htmlspecialchars($game['title']); ?>">
                <?php else: ?>
                    <div class="bg-secondary text-white p-5 rounded text-center">No image available</div>
                <?php endif; ?>
            </div>

            <div class="col-md-8">
                <h2><?php echo htmlspecialchars($game['title']); ?></h2>

                <p><strong>Developer:</strong> <?php echo htmlspecialchars($game['developer']); ?></p>
                <p><strong>Publisher:</strong> <?php echo htmlspecialchars($game['publisher']); ?></p>
                <p><strong>Release Date:</strong> <?php echo htmlspecialchars($game['release_date']); ?></p>

                <?php if (!empty($game['genres'])): ?>
                    <p><strong>Genres:</strong> <?php echo htmlspecialchars(implode(', ', $game['genres'])); ?></p>
                <?php endif; ?>

                <?php if (!empty($game['platforms'])): ?>
                    <p><strong>Platforms:</strong> <?php echo htmlspecialchars(implode(', ', $game['platforms'])); ?></p>
                <?php endif; ?>

                <?php if ($source !== 'api'): ?>
                    <div class="mb-3">
                        ⭐ <strong><?php echo number_format((float)$avgRating, 1); ?></strong> / 5
                    </div>
                <?php endif; ?>

                <p><?php echo htmlspecialchars($game['description']); ?></p>

                <?php if (!empty($game['storyline'])): ?>
                    <h5 class="mt-4">Storyline</h5>
                    <p><?php echo htmlspecialchars($game['storyline']); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($game['screenshots'])): ?>
            <hr class="my-5">
            <h4 class="mb-4">Screenshots</h4>
            <div class="row">
                <?php foreach ($game['screenshots'] as $shot): ?>
                    <div class="col-md-4 mb-4">
                        <img src="<?php echo htmlspecialchars($shot); ?>" class="img-fluid rounded shadow-sm" alt="Screenshot">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($source !== 'api'): ?>
            <hr class="my-5">
            <h4>Reviews</h4>

            <?php if ($reviews && $reviews->num_rows > 0): ?>
                <?php while ($r = $reviews->fetch_assoc()): ?>
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <!-- Review Contents -->
                                    <h6 class="mb-0"><?php echo htmlspecialchars($r['username']); ?></h6>
                                    <p class="mt-2 mb-1">⭐ <?php echo $r['rating']; ?> / 5</p>
                                    <strong><?php echo htmlspecialchars($r['title']); ?></strong>
                                    <p><small class="text-muted"><?php echo date("d M Y", strtotime($r['created_at'])); ?></small></p>
                                    <p class="mb-3"><?php echo htmlspecialchars($r['content']); ?></p>

                                    <!-- Like Button -->
                                    <div class="d-flex align-items-center gap-2">
                                        <?php if (isset($_SESSION['user_id'])): ?>
                                            <?php if ((int)$r['user_liked'] === 1): ?>
                                                <form action="unlike_review.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="review_id" value="<?php echo $r['review_id']; ?>">
                                                    <input type="hidden" name="game_id" value="<?php echo $gameId; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger">♥ Liked</button>
                                                </form>
                                            <?php else: ?>
                                                <form action="like_review.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="review_id" value="<?php echo $r['review_id']; ?>">
                                                    <input type="hidden" name="game_id" value="<?php echo $gameId; ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">♡ Like</button>
                                                </form>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="login.php" class="btn btn-sm btn-outline-secondary">Login to like</a>
                                        <?php endif; ?>
                                        <span class="text-muted">
                                            <?php echo (int)$r['like_count']; ?> like<?php echo ((int)$r['like_count'] === 1 ? '' : 's'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-end align-items-center">
                                    <!-- Edit Delete Button -->
                                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $r['user_id']): ?>
                                        <div class="d-flex gap-2">
                                            <a href="edit_review.php?id=<?php echo $r['review_id']; ?>&game_id=<?php echo $gameId; ?>"
                                                class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </a>
                                            <form action="delete_review.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                                <input type="hidden" name="review_id" value="<?php echo $r['review_id']; ?>">
                                                <input type="hidden" name="game_id" value="<?php echo $gameId; ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php else: ?>
                <p>No reviews yet. Be the first!</p>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($source !== 'api' && isset($_SESSION['user_id'])): ?>
            <hr class="my-5">

            <h5>Add a Review</h5>

            <form action="save_review.php" method="POST">
                <input type="hidden" name="game_id" value="<?php echo htmlspecialchars($gameId); ?>">

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
        <?php elseif ($source === 'api' && $isUpcomingApiGame): ?>
            <hr class="my-5">
            <div class="alert alert-info">
                This game has not been released yet, so reviews are not available.
            </div>
        <?php endif; ?>
    </div>

    <?php include 'include/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>