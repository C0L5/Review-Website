<?php
header('Content-Type: application/json');

$client_id = "";
$client_secret = "";

function getAccessToken($client_id, $client_secret)
{
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

    if (!isset($result['access_token'])) {
        echo json_encode(['error' => 'Could not get access token']);
        exit;
    }

    $data = [
        'access_token' => $result['access_token'],
        'expires_at' => time() + $result['expires_in'] - 60
    ];

    file_put_contents($cache_file, json_encode($data));

    return $data['access_token'];
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['error' => 'Missing or invalid game id']);
    exit;
}

$gameId = (int) $_GET['id'];
$access_token = getAccessToken($client_id, $client_secret);

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
    rating,
    total_rating,
    aggregated_rating,
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

echo $response;
?>