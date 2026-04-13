<?php

function getIgdbAccessToken()
{
    $client_id = "";
    $client_secret = "";  

    $cache_file = __DIR__ . '/token.json';

    if (file_exists($cache_file)) {
        $data = json_decode(file_get_contents($cache_file), true);

        if (!empty($data['access_token']) && time() < $data['expires_at']) {
            return $data['access_token'];
        }
    }

    $url = "https://id.twitch.tv/oauth2/token";

    $params = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'client_credentials'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if (empty($result['access_token'])) {
        return null;
    }

    $data = [
        'access_token' => $result['access_token'],
        'expires_at' => time() + $result['expires_in'] - 60
    ];

    file_put_contents($cache_file, json_encode($data));

    return $data['access_token'];
}

function getUpcomingGamesFromIgdb()
{
    $client_id = "";
    $access_token = getIgdbAccessToken();

    if (!$access_token) {
        return [];
    }

    $now = time();

    $query = "
        fields name, first_release_date, cover.url;
        where first_release_date != null & first_release_date > $now;
        sort first_release_date asc;
        limit 12;
    ";

    $ch = curl_init("https://api.igdb.com/v4/games");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Client-ID: $client_id",
        "Authorization: Bearer $access_token",
        "Content-Type: text/plain"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return is_array($data) ? $data : [];
}

function getIgdbGameById($gameId)
{
    $client_id = "";
    $access_token = getIgdbAccessToken();

    if (!$access_token || !is_numeric($gameId)) {
        return null;
    }

    $gameId = (int)$gameId;

    $query = "
        fields
            name,
            summary,
            storyline,
            first_release_date,
            cover.url,
            involved_companies.company.name,
            involved_companies.developer,
            involved_companies.publisher,
            screenshots.url,
            genres.name,
            platforms.name,
            status;
        where id = $gameId;
        limit 1;
    ";

    $ch = curl_init("https://api.igdb.com/v4/games");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Client-ID: $client_id",
        "Authorization: Bearer $access_token",
        "Content-Type: text/plain"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (!is_array($data) || empty($data[0])) {
        return null;
    }

    return $data[0];
}