<?php
session_start();
include 'db.php';
require_once 'include/userProfile.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$reviewObj = new ReviewObj($conn);

$user = $reviewObj->getUserData($user_id);
$reviews = $reviewObj->getUserReviews($user_id);
$reviewLikes = $reviewObj->getUserLikes($user_id);
$wishList = $reviewObj->getUserWishList($user_id);

$isInWishlist = true;
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
            <img
                src="<?php echo !empty($user['profile_picture']) ? 'uploads/' . $user['profile_picture'] : 'images/default-avatar.png'; ?>"
                class="rounded-circle border border-white"
                style="height: 80px; width: 80px; object-fit:cover;">

            <div class="ms-3 px-3">
                <h4><?php echo htmlspecialchars($user['username']); ?></h4>

                <p class="mb-0">
                    <?php echo !empty($user['bio']) ? htmlspecialchars($user['bio']) : 'No bio yet'; ?>
                </p>

                <p>
                    Genre: <?php echo !empty($user['favorite_genre']) ? htmlspecialchars($user['favorite_genre']) : 'Not set'; ?>
                </p>

                <p><?php echo $reviews->num_rows; ?> Reviews</p>
            </div>
            <div class="ms-auto">
                <a href="editProfile.php" class="text-white">Edit Profile</a>
            </div>
        </div>
        <!-- Tabs -->
        <ul class="nav nav-tabs mt-3 mb-3" id="profileTabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#reviewsTab">Reviews</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#likesTab">Likes</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#wishListTab">Wishlist</button>
            </li>
        </ul>
        <div class="tab-content">
            <!-- Reviews -->
            <div class="tab-pane fade show active" id="reviewsTab">
                <?php while ($review = $reviews->fetch_assoc()): ?>
                    <div class="card mb-3 p-3 d-flex flex-row">
                        <div>
                            <h5><?php echo htmlspecialchars($review['game_title']); ?></h5>
                            <p class="mb-1">⭐ <?php echo $review['rating']; ?>/5</p>
                            <p class="mb-1"><strong><?php echo htmlspecialchars($review['title']); ?></strong></p>
                            <p class="mb-4"><small><?php echo htmlspecialchars($review['created_at']); ?></small></p>
                            <p><?php echo htmlspecialchars($review['content']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <!-- Likes -->
            <div class="tab-pane fade" id="likesTab">
                <?php while ($reviewsLikes = $reviewLikes->fetch_assoc()): ?>
                    <div class="card mb-3 p-3 d-flex flex-row">
                        <div>
                            <h5><?php echo htmlspecialchars($reviewsLikes['game_title']); ?></h5>
                            <p class="mb-1">⭐ <?php echo $reviewsLikes['rating']; ?>/5</p>
                            <p class="mb-1"><strong><?php echo htmlspecialchars($reviewsLikes['title']); ?></strong></p>
                            <p class="mb-4"><small><?php echo htmlspecialchars($reviewsLikes['created_at']); ?></small></p>
                            <p><?php echo htmlspecialchars($reviewsLikes['content']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <!-- Wishlist -->
            <div class="tab-pane fade" id="wishListTab">
                <?php while ($wish = $wishList->fetch_assoc()): ?>
                    <div class="card mb-3 p-3 d-flex flex-row">
                        <div class="card-body p-0">
                            <div class="row align-items-center g-3">
                                <div class="col-md-3"><img src="/<?php echo htmlspecialchars($wish['cover_image']); ?>" class="img-fluid wishlist-img"></div>
                                <div class="col-md-7">
                                    <h5><?php echo htmlspecialchars($wish['title']); ?></h5>
                                    <strong><?php echo htmlspecialchars($wish['developer']); ?></strong>
                                </div>
                                <div class="col-md-2 d-flex md-justify-content-end">
                                    <?php if ($isInWishlist): ?>
                                        <form action="remove_from_wishlist.php" method="POST">
                                            <input type="hidden" name="redirect_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                            <input type="hidden" name="game_id" value="<?php echo htmlspecialchars($wish['game_id']); ?>">
                                            <button type="submit" class="btn btn-danger w-100">
                                                ♥ Remove from Wishlist
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
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