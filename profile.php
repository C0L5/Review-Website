<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
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

    <div class="container mt-5" style="max-width: 70vw;">
        <!-- Avatar & Username -->
        <div class="d-flex align-items-center mt-n5 px-3">
            <img src="images/ign_ferrari1.png" class="rounded-circle border border-white" style="height: 80px; width: 80px; object-fit:cover;">
            <div class="ms-3 px-3">
                <h4><?php echo htmlspecialchars($_SESSION['username']); ?></h4>
                <p class="mb-0">Bio Here</p>
                <p>Genre: RPG</p>
                <small>27 Reviews</small>
            </div>
            <div class="ms-auto">
                <a href="editProfile.php" class="text-white">Edit Profile</a>
            </div>
        </div>
        <!-- Tabs -->
        <ul class="nav nav-tabs mt-3 mb-3">
            <li class="nav-item"><a class="nav-link active">Reviews</a></li>

        </ul>

        <!-- Reviews -->
        <div class="card mb-3 p-3 d-flex flex-row">
            <img src="game.jpg" width="80" class="me-3">
            <div>
                <h5>Game Title</h5>
                <p>⭐⭐⭐⭐☆</p>
                <p>Short review preview...</p>
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