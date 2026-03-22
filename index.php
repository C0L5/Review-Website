<!DOCTYPE html>
<?php session_start(); ?>
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
                        <a href="trending.html" class="text-decoration-none">See all</a>
                    </div>
                    <!--Trending Games Card-->
                    <div class="row">
                        <div class="col">
                            <a href="#">
                                <div class="card">
                                    <img src="images/nintendoGames/pokopia.png" class="img-fluid trendingImg">
                                    <div class=" card-body">
                                        <h2>Pokopia</h2>
                                        <p>March 5, 2026</p>
                                        <p>SHORT DESC</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#">
                                <div class="card">
                                    <img src="images/pcGames/crimsonDesert.jpg" class="img-fluid trendingImg">
                                    <div class="card-body">
                                        <h2>Crimson Desert</h2>
                                        <p>March 19, 2026</p>
                                        <p>SHORT DESC</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#">
                                <div class="card">
                                    <img src="images/psGames/ghostOfYotei.jpg" class="img-fluid trendingImg">
                                    <div class="card-body">
                                        <h2>Ghost of Yotei</h2>
                                        <p>October 2, 2025</p>
                                        <p>SHORT DESC</p>
                                    </div>
                                </div>
                            </a>
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