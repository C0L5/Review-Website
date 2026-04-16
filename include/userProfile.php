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
                SELECT r.title, r.content, r.rating, r.created_at, g.title AS game_title
                FROM reviews r
                JOIN games g ON r.game_id = g.game_id
                WHERE r.user_id = ?
                ORDER BY r.created_at DESC
            ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getUserLikes($user_id)
    {
        $stmt = $this->conn->prepare("
        SELECT r.title, r.content, r.rating, r.created_at, g.title AS game_title
        FROM review_likes rl
        JOIN reviews r ON rl.review_id = r.review_id
        JOIN games g ON r.game_id = g.game_id
        WHERE rl.user_id = ?
        ORDER BY r.created_at DESC
    ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getUserWishList($user_id)
    {
        $stmt = $this->conn->prepare("SELECT g.title, g.cover_image, g.game_id, g.developer
                                    FROM user_favorites uf
                                    JOIN games g ON uf.game_id = g.game_id
                                    JOIN users u ON uf.user_id = u.user_id
                                    WHERE uf.user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
