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

    <div class="container my-5">

        <!-- GAME HEADER -->
        <div class="row g-4">
            <!-- Game Image -->
            <div class="col-md-4">
                <img src="images/ign_ferrari1.png"
                    class="img-fluid rounded shadow-sm"
                    alt="Game Image">
            </div>

            <!-- Game Info -->
            <div class="col-md-8">
                <h2>Game Title</h2>

                <p class="text-muted mb-1">
                    By <strong>Game Studio / Developer</strong>
                </p>

                <!-- Rating -->
                <div class="mb-2">
                    <span class="star">⭐⭐⭐⭐☆</span>
                    <span class="text-muted">(4.0 / 5)</span>
                </div>

                <!-- Description -->
                <p>
                    This is a sample description of the game. It explains gameplay, features,
                    and what makes the game interesting. You can replace this later with
                    real data from your database.
                </p>
            </div>
        </div>

        <hr class="my-5">

        <!-- REVIEWS SECTION -->
        <div class="row">
            <div class="col-12">
                <h4>Reviews</h4>

                <!-- Review Item -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="mb-1">Username123</h6>
                        <div class="star mb-2">⭐⭐⭐⭐☆</div>
                        <p class="mb-0">
                            Really fun game, enjoyed the mechanics and story!
                        </p>
                    </div>
                </div>

                <!-- Review Item -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="mb-1">Player456</h6>
                        <div class="star mb-2">⭐⭐⭐☆☆</div>
                        <p class="mb-0">
                            It was okay, but could use more content.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <hr class="my-5">

        <!-- ADD REVIEW -->
        <div class="row">
            <div class="col-12">
                <h5>Add a Review</h5>

                <form>
                    <!-- Rating -->
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select class="form-select">
                            <option>⭐</option>
                            <option>⭐⭐</option>
                            <option>⭐⭐⭐</option>
                            <option>⭐⭐⭐⭐</option>
                            <option>⭐⭐⭐⭐⭐</option>
                        </select>
                    </div>

                    <!-- Comment -->
                    <div class="mb-3">
                        <label class="form-label">Comment</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit Review
                    </button>
                </form>
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