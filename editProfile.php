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

    <div class="container mt-5" style="max-width: 700px;">
        <h2>Edit Profile</h2>
        <form action="update_profile.php" method="POST" enctype="multipart/form-data">

            <!-- Avatar Upload -->
            <div class="mb-3">
                <label for="avatar" class="form-label">Profile Picture</label>
                <input class="form-control" type="file" id="avatar" name="avatar" accept="image/*">
                <img id="avatarPreview" src="avatar.jpg" class="avatar-preview mt-2" alt="Avatar Preview">
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required>
            </div>

            <!-- Bio -->
            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea class="form-control" id="bio" name="bio" rows="3">Gamer who loves RPGs and story-driven games.</textarea>
            </div>

            <!-- Favorite Genre -->
            <div class="mb-3">
                <label for="genre" class="form-label">Favorite Genre</label>
                <select class="form-select" id="genre" name="favorite_genre">
                    <option>RPG</option>
                    <option>FPS</option>
                    <option>Adventure</option>
                    <option>Strategy</option>
                    <option>Simulation</option>
                </select>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="profile.php" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>

    <!--The footer-->
    <?php include 'include/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
</body>

</html>