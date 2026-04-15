<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid my-2">
        <a class="navbar-brand" href="/index.php">
            <img src="/images/reviewLogoNav.png" alt="LOGO" class="img-fluid px-3" style="height:70px; width:auto;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

            <div class="navbar-nav" style="font-size: 1.2rem;">
                <a class="nav-link" href="/index.php">Home</a>
                <a class="nav-link" href="/reviews.php">Reviews</a>
                <a class="nav-link" href="/upcomingGames.php">Upcoming Games</a>
            </div>

            <form class="d-flex px-lg-4 flex-grow-1" role="search" action="search.php" method="GET">
                <input
                    class="form-control"
                    type="search"
                    placeholder="Search games..."
                    name="searchbar"
                    value="<?php echo isset($_GET['searchbar']) ? htmlspecialchars($_GET['searchbar']) : ''; ?>" />
            </form>

            <div class="d-flex pt-2 pt-lg-0 gap-2">

                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="text-white">
                                <img
                                    src="<?php echo !empty($_SESSION['profile_picture']) ? 'uploads/' . $_SESSION['profile_picture'] : 'images/default-avatar.png'; ?>"
                                    class="rounded-circle border border-white me-2"
                                    style="width:35px; height:35px; border-radius:50%; object-fit:cover;">
                                <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end mt-md-3">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <li><a class="dropdown-item" href="admin/dashboard.php">Admin Panel</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>

                <?php else: ?>

                    <a href="signup.php" class="btn btn-outline-light">Sign up</a>
                    <a href="login.php" class="btn btn-light">Login</a>

                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>