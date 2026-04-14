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

$reviewId = $_POST['review_id'] ?? null;
$gameId = $_POST['game_id'] ?? null;

if (!$reviewId || !$gameId) {
    die("Invalid request.");
}

$stmt = $conn->prepare("SELECT user_id FROM reviews WHERE review_id = ?");
$stmt->bind_param("i", $reviewId);
$stmt->execute();
$review = $stmt->get_result()->fetch_assoc();

if (!$review) {
    die("Review not found.");
}

if ($review['user_id'] != $_SESSION['user_id']) {
    die("You are not allowed to delete this review.");
}

$stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
$stmt->bind_param("i", $reviewId);
$stmt->execute();

header("Location: games.php?id=" . $gameId);
exit();