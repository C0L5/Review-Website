<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$game_id = (int)$_POST['game_id'];
$title = trim($_POST['title']);
$content = trim($_POST['content']);
$rating = (float)$_POST['rating'];
var_dump($_POST['game_id']);
$stmt = $conn->prepare("
    INSERT INTO reviews (user_id, game_id, title, content, rating) 
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("iissd", $user_id, $game_id, $title, $content, $rating);
$stmt->execute();

header("Location: games.php?id=" . $game_id);
exit();
