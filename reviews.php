<!DOCTYPE html>
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

    <!-- Main Content -->
    <div class="container-fluid px-4 mt-5">
        <div class="row">
            <!-- Filter Side Bar -->
            <div class="col-md-3">
                <form method="get" class="sidebar">
                    <h5 class="mb-3">Filter</h5>
                    <!-- Rating Range -->
                    <div class="mb-3">
                        <label for="ratingFilter" class="form-label">Minimum Rating</label>
                        <select name="rating" id="ratingFilter" class="form-select">
                            <option value="">Any</option>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                $selected = (isset($_GET['rating']) && $_GET['rating'] == $i) ? 'selected' : '';
                                echo "<option value=\"$i\" $selected>"
                                    . str_repeat("⭐", $i) .
                                    "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Category Dropdown -->
                    <div class="mb-3">
                        <label for="categoryFilter" class="form-label">Category</label>
                        <select name="category" id="categoryFilter" class="form-select">
                            <option value="">Any</option>
                        </select>
                    </div>
                    <!-- SUBMIT -->
                    <button type="submit" class="btn mt-3 btn-light">Apply Filters</button>
                </form>
            </div>
            <!-- Game Cards -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <a href="games.php">
                                <div class="card-body">
                                    <img src="images/ign_ferrari1.png" class="img-fluid">
                                    <h3>GAME TITLE</h3>
                                    <p>RATING</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-body">
                                    <img src="images/ign_ferrari1.png" class="img-fluid">
                                    <h3>GAME TITLE</h3>
                                    <p>RATING</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-body">
                                    <img src="images/ign_ferrari1.png" class="img-fluid">
                                    <h3>GAME TITLE</h3>
                                    <p>RATING</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <a href="#">
                                <div class="card-body">
                                    <img src="images/ign_ferrari1.png" class="img-fluid">
                                    <h3>GAME TITLE</h3>
                                    <p>RATING</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--The footer-->
    <?php include 'include/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
</body>

</html>