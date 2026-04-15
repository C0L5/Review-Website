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
$reviewId = $_POST['review_id'] ?? null;
$gameId = $_POST['game_id'] ?? null;

if (!$reviewId || !$gameId) {
    die("Invalid request.");
}

$stmt = $conn->prepare("
    DELETE FROM review_likes
    WHERE user_id = ? AND review_id = ?
");
$stmt->bind_param("ii", $userId, $reviewId);
$stmt->execute();

header("Location: games.php?id=" . $gameId);
exit();