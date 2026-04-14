<?php

class GameModel
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Get single game
    public function getGameById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM games WHERE game_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Get reviews for a game
    public function getReviews($gameId)
    {
        $stmt = $this->conn->prepare("
            SELECT r.review_id, r.user_id, r.game_id, r.title, r.content, r.rating, r.created_at, u.username
            FROM reviews r
            JOIN users u ON r.user_id = u.user_id
            WHERE r.game_id = ?
            ORDER BY r.created_at DESC
        ");
        $stmt->bind_param("i", $gameId);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Get average rating
    public function getAverageRating($gameId)
    {
        $stmt = $this->conn->prepare("
            SELECT AVG(rating) as avg_rating 
            FROM reviews 
            WHERE game_id = ?
        ");
        $stmt->bind_param("i", $gameId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['avg_rating'] ?? 0;
    }

    // Get all games with optional filters
    public function getGames($category = null, $minRating = null)
    {

        $sql = "
            SELECT 
                g.game_id, 
                g.title, 
                g.cover_image, 
                g.release_date,
                AVG(r.rating) AS avg_rating
            FROM games g
            LEFT JOIN reviews r ON g.game_id = r.game_id
            LEFT JOIN game_genres gg ON g.game_id = gg.game_id
            LEFT JOIN genres ge ON gg.genre_id = ge.genre_id
            WHERE 1=1
        ";

        $params = [];
        $types = "";

        if ($category) {
            $sql .= " AND ge.name = ?";
            $params[] = $category;
            $types .= "s";
        }

        $sql .= " GROUP BY g.game_id";

        if ($minRating) {
            $sql .= " HAVING avg_rating >= ?";
            $params[] = $minRating;
            $types .= "i";
        }

        $stmt = $this->conn->prepare($sql);

        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result();
    }
}
