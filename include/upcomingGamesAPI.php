<?php
header('Content-Type: application/json');

include 'igdbHelper.php';

$igdb = new IgdbApi();

try {
    $games = $igdb->getUpcomingGames(12);
    echo json_encode($games);
} catch (\Throwable $e) {
    // Return a proper JSON error response
    http_response_code(500);
    echo json_encode([
        'error' => 'Server error',
        'message' => $e->getMessage()
    ]);
}
