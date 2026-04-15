<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        header("Location: login.php?error=empty_fields&email=" . urlencode($email));
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['profile_picture'] = $user['profile_picture'] ?? null;

            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=invalid_password&email=" . urlencode($email));
            exit();
        }
    } else {
        header("Location: login.php?error=user_not_found&email=" . urlencode($email));
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>