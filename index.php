<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
</head>

<body class="d-flex flex-column">
    <!-- Navigation Bar -->
    <?php include 'include/navigationBar.php' ?>

    <!--Featured Game Here-->
    <section class="py-5">
        <div class="container-fluid px-5">
            <div class="featuredGame text-white d-flex align-items-center">
                <div class="conten px-5">
                    <p>Featured Game</p>
                    <h1 class="display-4 fw-bold">Arc Raiders</h1>
                    <div class="mb-3 text-warning">
                        ★★★★★
                    </div>
                    <p>Short description of the featured game review</p>
                    <a href="#" class="btn btn-primary mt-3">Read Review</a>
                </div>
            </div>
        </div>
    </section>

    <!--Trending and Discover-->
    <section>
        <div class="container-fluid px-5">
            <!--Trending Grid -->
            <div class="row">
                <div class="col-md-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="mb-0">Trending</p>

                        <div>
                            <a href="trending.html" class="text-decoration-none me-3">See all</a>

                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="add_review.php" class="btn btn-primary btn-sm">+ Add Review</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--Trending Games Card-->
                    <?php
                    $trending = $conn->query("
                        SELECT game_id, title, release_date, cover_image 
                        FROM games 
                        ORDER BY release_date DESC 
                        LIMIT 3
                    ");
                    ?>
                    <div class="row">
                        <div class="row">
                            <?php while ($game = $trending->fetch_assoc()): ?>
                                <div class="col">
                                    <a href="games.php?id=<?php echo $game['game_id']; ?>">
                                        <div class="card h-100">
                                            
                                            <img src="<?php echo htmlspecialchars($game['cover_image']); ?>" 
                                                class="img-fluid trendingImg">

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
                        </div>
                        <div class="row">
                        <?php while ($game = $trending->fetch_assoc()): ?>
                            <div class="col">
                                <a href="games.php?id=<?php echo $game['game_id']; ?>">
                                    <div class="card h-100">
                                        
                                        <img src="<?php echo htmlspecialchars($game['cover_image']); ?>" 
                                            class="img-fluid trendingImg">

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
                        </div>
                        <div class="row">
                        <?php while ($game = $trending->fetch_assoc()): ?>
                            <div class="col">
                                <a href="games.php?id=<?php echo $game['game_id']; ?>">
                                    <div class="card h-100">
                                        
                                        <img src="<?php echo htmlspecialchars($game['cover_image']); ?>" 
                                            class="img-fluid trendingImg">

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
                    </div>
                        
                    </div>
                </div>
                <!--Discover Grid-->
                <div class="col-md-4">
                    <p>Discover</p>
                    <div class="row">
                        <div class="col">
                            <a href="#">
                                <div class="card card-discover">
                                    <img src="images/playstationLogo.svg" class="img-fluid brandLogo">
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#">
                                <div class="card card-discover">
                                    <img src="images/nintendoSwitchLogo.svg" class="img-fluid brandLogo">
                                </div>
                            </a>

                        </div>
                        <div class="col">
                            <a href="#">
                                <div class="card card-discover">
                                    <img src="images/steamLogo.svg" class="img-fluid brandLogo">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--The footer-->
    <?php include 'include/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>