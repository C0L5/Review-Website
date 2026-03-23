<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = trim($_POST['username']);
$bio = trim($_POST['bio']);
$genre = $_POST['favorite_genre'];

$avatarName = null;

if (!empty($_FILES['avatar']['name'])) {
    $targetDir = "uploads/";
    
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $avatarName = time() . "_" . basename($_FILES["avatar"]["name"]);
    $targetFile = $targetDir . $avatarName;

    move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile);
}

if ($avatarName) {
    $stmt = $conn->prepare("UPDATE users SET username=?, bio=?, favorite_genre=?, profile_picture=? WHERE user_id=?");
    $stmt->bind_param("ssssi", $username, $bio, $genre, $avatarName, $user_id);
} else {
    $stmt = $conn->prepare("UPDATE users SET username=?, bio=?, favorite_genre=? WHERE user_id=?");
    $stmt->bind_param("sssi", $username, $bio, $genre, $user_id);
}

$stmt->execute();

$_SESSION['username'] = $username;

header("Location: profile.php");
exit();
?>