<?php
include '../include/admin_only.php';
include '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: reviews.php");
    exit();
}

$stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: reviews.php");
exit();