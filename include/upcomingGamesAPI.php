<?php
header('Content-Type: application/json');

$client_id = "";
$client_secret = "";

function getAccessToken($client_id, $client_secret)
{
    $cache_file = 'token.json';

    if (file_exists($cache_file)) {
        $data = json_decode(file_get_contents($cache_file), true);

        if (time() < $data['expires_at']) {
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
    $result = json_decode($response, true);

    $data = [
        'access_token' => $result['access_token'],
        'expires_at' => time() + $result['expires_in'] - 60
    ];

    file_put_contents($cache_file, json_encode($data));

    return $data['access_token'];
}

$access_token = getAccessToken($client_id, $client_secret);

$now = time();

$query = " fields name, first_release_date, cover.url;
where first_release_date != null & first_release_date > $now;
sort first_release_date asc;
limit 12;";

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
echo $response;