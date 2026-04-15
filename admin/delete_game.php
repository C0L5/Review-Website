<?php
include '../include/admin_only.php';
include '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: games.php");
    exit();
}

$stmt = $conn->prepare("DELETE FROM games WHERE game_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: games.php");
exit();