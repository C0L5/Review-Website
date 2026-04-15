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
    <?php include 'include/navigationBar.php' ?>

    <div class="container d-flex justify-content-center align-items-center flex-grow-1" style="max-width: 400px;">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">

            <h3 class="text-center mb-4">Login</h3>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php
                    if ($_GET['error'] === 'invalid_password') {
                        echo "Incorrect password.";
                    } elseif ($_GET['error'] === 'user_not_found') {
                        echo "No account found with that email.";
                    } elseif ($_GET['error'] === 'empty_fields') {
                        echo "Please fill in all fields.";
                    } else {
                        echo "Login failed. Please try again.";
                    }
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form action="login_process.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Login
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="#">Forgot password?</a>
            </div>

            <div class="text-center mt-2">
                <span>Don't have an account?</span>
                <a href="signup.php">Sign up</a>
            </div>

        </div>
    </div>

    <?php include 'include/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>