<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <style>
        .featuredGame {
            background: linear-gradient(to right, rgba(10, 15, 25, 0.9), rgba(10, 15, 25, 0.3)), url('images/arcRaidersAlternative.jpg') center/cover no-repeat;
            min-height: 500px;
            border-radius: 12px;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100" style="background-image: linear-gradient(to bottom, #141c2b, #0a0f19); color: white;">
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
                        <a href="#" class="text-decoration-none">See all</a>
                    </div>
                    <!--Trending Games Card-->
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="images/ign_ferrari1.png" class="img-fluid">
                                <div class="card-body">
                                    <p>TITLE</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="images/ign_ferrari1.png" class="img-fluid">
                                <div class="card-body">
                                    <p>TITLE</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="images/ign_ferrari1.png" class="img-fluid">
                                <div class="card-body">
                                    <p>TITLE</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Discover Grid-->
                <div class="col-md-4">
                    <p>Discover</p>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="images/ign_ferrari1.png" class="img-fluid">
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="images/ign_ferrari1.png" class="img-fluid">
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="images/ign_ferrari1.png" class="img-fluid">
                            </div>
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