<?php
include '../include/admin_only.php';
include '../db.php';

$gameCount = $conn->query("SELECT COUNT(*) as total FROM games")->fetch_assoc()['total'];
$userCount = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$reviewCount = $conn->query("SELECT COUNT(*) as total FROM reviews")->fetch_assoc()['total'];

$games = $conn->query("SELECT * FROM games ORDER BY created_at DESC");
$users = $conn->query("SELECT user_id, username, email, role, created_at FROM users ORDER BY created_at DESC");
$reviews = $conn->query("
    SELECT r.review_id, r.title, r.rating, r.created_at, u.username, g.title AS game_title
    FROM reviews r
    JOIN users u ON r.user_id = u.user_id
    JOIN games g ON r.game_id = g.game_id
    ORDER BY r.created_at DESC
");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column">
    <?php include '../include/navigationBar.php' ?>

    <div class="container my-5">
        <h2 class="mb-4 text-white">Admin Dashboard</h2>

        <div class="row g-2">
            <div class="col-4">
                <div class="card shadow-sm p-4">
                    <h4><?php echo $gameCount; ?></h4>
                    <p class="mb-0">Games</p>
                </div>
            </div>

            <div class="col-4">
                <div class="card shadow-sm p-4">
                    <h4><?php echo $userCount; ?></h4>
                    <p class="mb-0">Users</p>
                </div>
            </div>

            <div class="col-4">
                <div class="card shadow-sm p-4">
                    <h4><?php echo $reviewCount; ?></h4>
                    <p class="mb-0">Reviews</p>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <!-- MOBILE MENU BUTTON -->
        <button class="btn btn-dark d-md-none m-3" data-bs-toggle="collapse" data-bs-target="#sideBarMenu">
            ☰ Admin
        </button>
        <div class="row g-0">
            <!-- SIDEBAR -->
            <div class="col-md-3 sidebar p-3">
                <div class="collapse d-md-block" id="sideBarMenu">
                    <h5 class="mb-4 text-white">Menu</h5>
                    <a class="sideBarLink active" data-target="games">Games</a>
                    <a class="sideBarLink" data-target="users">Users</a>
                    <a class="sideBarLink" data-target="reviews">Reviews</a>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="col-md-9 p-3 p-md-4">

                <div id="games" class="content-section">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-4 text-white">Manage Games</h2>
                        <a href="add_game.php" class="btn btn-success">Add Game</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Developer</th>
                                    <th>Release Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($game = $games->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $game['game_id']; ?></td>
                                        <td><img src="../<?php echo htmlspecialchars($game['cover_image']); ?>" style="width:60px; height:80px; object-fit:cover;"></td>
                                        <td><?php echo htmlspecialchars($game['title']); ?></td>
                                        <td><?php echo htmlspecialchars($game['developer']); ?></td>
                                        <td><?php echo htmlspecialchars($game['release_date']); ?></td>
                                        <td>
                                            <a href="edit_game.php?id=<?php echo $game['game_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="delete_game.php?id=<?php echo $game['game_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this game?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="users" class="content-section d-none">

                    <h2 class="mb-4 text-white">Manage Users</h2>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($user = $users->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $user['user_id']; ?></td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                                        <td>
                                            <a href="edit_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="delete_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="reviews" class="content-section d-none">
                    <h2 class="mb-4 text-white">Manage Reviews</h2>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Game</th>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Rating</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($review = $reviews->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $review['review_id']; ?></td>
                                        <td><?php echo htmlspecialchars($review['game_title']); ?></td>
                                        <td><?php echo htmlspecialchars($review['username']); ?></td>
                                        <td><?php echo htmlspecialchars($review['title']); ?></td>
                                        <td><?php echo htmlspecialchars($review['rating']); ?></td>
                                        <td><?php echo htmlspecialchars($review['created_at']); ?></td>
                                        <td>
                                            <a href="delete_review.php?id=<?php echo $review['review_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this review?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include '../include/footer.php' ?>
    <script>
        document.querySelectorAll('.sideBarLink').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const target = this.getAttribute('data-target');

                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.add('d-none');
                });

                document.getElementById(target).classList.remove('d-none');

                document.querySelectorAll('.sideBarLink').forEach(l => {
                    l.classList.remove('active');
                });

                this.classList.add('active');

                const sidebar = document.getElementById('sideBarMenu');
                if (window.innerWidth < 768) {
                    new bootstrap.Collapse(sidebar).hide();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>