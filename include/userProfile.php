<?php

class ReviewObj
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserData($user_id)
    {
        $stmt = $this->conn->prepare("SELECT username, bio, favorite_genre, profile_picture FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getUserReviews($user_id)
    {
        $stmt = $this->conn->prepare("
                SELECT r.title, r.content, r.rating, g.title AS game_title
                FROM reviews r
                JOIN games g ON r.game_id = g.game_id
                WHERE r.user_id = ?
                ORDER BY r.created_at DESC
            ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
