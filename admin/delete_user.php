<?php
include '../include/admin_only.php';
include '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: users.php");
    exit();
}

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
    die("You cannot delete your own admin account.");
}

$stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: users.php");
exit();