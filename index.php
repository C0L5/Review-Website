<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

$featuredResult = $conn->query("
    SELECT game_id, title, description, cover_image, release_date
    FROM games
    ORDER BY release_date DESC
    LIMIT 1
");
$featuredGame = $featuredResult ? $featuredResult->fetch_assoc() : null;

$trending = $conn->query("
    SELECT game_id, title, release_date, cover_image
    FROM games
    ORDER BY release_date DESC
    LIMIT 3
");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">

    <style>
        .featuredGame {
            position: relative;
            min-height: 500px;
            overflow: hidden;
            border-radius: 20px;
            background: #111;
        }

        .featuredGame::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.82) 20%, rgba(0, 0, 0, 0.45) 55%, rgba(0, 0, 0, 0.20) 100%),
                url('<?php echo $featuredGame ? htmlspecialchars($featuredGame['cover_image']) : ''; ?>');
            background-size: cover;
            background-position: center;
            transform: scale(1.08);
            animation: featuredPan 12s ease-in-out infinite alternate;
        }

        .featuredGame .content {
            position: relative;
            z-index: 2;
            max-width: 600px;
        }

        .featuredGame .featuredTag {
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .featuredDescription {
            max-width: 520px;
            color: rgba(255, 255, 255, 0.9);
        }

        @keyframes featuredPan {
            0% {
                transform: scale(1.08) translateX(0) translateY(0);
            }
            100% {
                transform: scale(1.14) translateX(-18px) translateY(-8px);
            }
        }

        .trendingImg {
            height: 260px;
            object-fit: cover;
        }

        .gameCardLink {
            text-decoration: none;
            color: inherit;
        }

        .gameCardLink:hover {
            color: inherit;
        }

        .card.h-100 {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card.h-100:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.22);
        }
    </style>
</head>

<body class="d-flex flex-column">
    <?php include 'include/navigationBar.php' ?>

    <section class="py-5">
        <div class="container-fluid px-5">
            <?php if ($featuredGame): ?>
                <div class="featuredGame text-white d-flex align-items-center px-5">
                    <div class="content">
                        <p class="featuredTag mb-2">Featured Game</p>

                        <h1 class="display-4 fw-bold">
                            <?php echo htmlspecialchars($featuredGame['title']); ?>
                        </h1>

                        <p class="mb-2">
                            Release Date:
                            <?php echo date("F j, Y", strtotime($featuredGame['release_date'])); ?>
                        </p>

                        <p class="featuredDescription mb-4">
                            <?php
                            $description = $featuredGame['description'] ?? 'No description available.';
                            echo htmlspecialchars(strlen($description) > 140 ? substr($description, 0, 140) . '...' : $description);
                            ?>
                        </p>

                        <a href="games.php?id=<?php echo $featuredGame['game_id']; ?>" class="btn btn-primary">
                            View Details
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="featuredGame text-white d-flex align-items-center px-5">
                    <div class="content">
                        <p class="featuredTag mb-2">Featured Game</p>
                        <h1 class="display-4 fw-bold">No featured game found</h1>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Trending and Discover -->
    <section>
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="mb-0">Trending</p>
                        <div>
                            <a href="trending.php" class="text-decoration-none me-3 text-light">See all</a>
                        </div>
                    </div>

                    <div class="row">
                        <?php if ($trending && $trending->num_rows > 0): ?>
                            <?php while ($game = $trending->fetch_assoc()): ?>
                                <div class="col-md-4 mb-4">
                                    <a class="gameCardLink" href="games.php?id=<?php echo $game['game_id']; ?>">
                                        <div class="card h-100">
                                            <img src="<?php echo htmlspecialchars($game['cover_image']); ?>"
                                                class="img-fluid trendingImg"
                                                alt="<?php echo htmlspecialchars($game['title']); ?>">

                                            <div class="card-body">
                                                <h5><?php echo htmlspecialchars($game['title']); ?></h5>

                                                <p>
                                                    <?php echo date("F j, Y", strtotime($game['release_date'])); ?>
                                                </p>

                                                <p>Click to view details</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No trending games found.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Discover Grid -->
                <div class="col-md-4">
                    <p>Discover</p>
                    <div class="row">
                        <div class="col">
                            <a href="#">
                                <div class="card card-discover">
                                    <img src="images/playstationLogo.svg" class="img-fluid brandLogo" alt="PlayStation">
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#">
                                <div class="card card-discover">
                                    <img src="images/nintendoSwitchLogo.svg" class="img-fluid brandLogo" alt="Nintendo Switch">
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#">
                                <div class="card card-discover">
                                    <img src="images/steamLogo.svg" class="img-fluid brandLogo" alt="Steam">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'include/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>