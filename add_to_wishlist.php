<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['user_id'];
$gameId = $_POST['game_id'] ?? null;

if (!$gameId) {
    die("Invalid request.");
}

$stmt = $conn->prepare("
    INSERT IGNORE INTO user_favorites (user_id, game_id)
    VALUES (?, ?)
");
$stmt->bind_param("ii", $userId, $gameId);
$stmt->execute();

header("Location: games.php?id=" . $gameId);
exit();