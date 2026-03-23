<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT username, bio, favorite_genre, profile_picture FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
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
                <img id="avatarPreview" 
                src="<?php echo !empty($user['profile_picture']) ? 'uploads/' . $user['profile_picture'] : 'images/default-avatar.png'; ?>" 
                class="avatar-preview mt-2" 
                alt="Avatar Preview">
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo htmlspecialchars($user['username']); ?>">
            </div>

            <!-- Bio -->
            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
               <textarea class="form-control" id="bio" name="bio" rows="3"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
            </div>

            <!-- Favorite Genre -->
            <div class="mb-3">
                <label for="genre" class="form-label">Favorite Genre</label>
                <select class="form-select" id="genre" name="favorite_genre">
                    <?php
                    $genres = ["RPG", "FPS", "Adventure", "Strategy", "Simulation"];
                    foreach ($genres as $g) {
                        $selected = ($user['favorite_genre'] === $g) ? "selected" : "";
                        echo "<option $selected>$g</option>";
                    }
                    ?>
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