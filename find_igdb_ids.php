<?php
include 'include/igdbHelper.php';

$games = [
    1 => 'Pokémon Pokopia',
    2 => 'Crimson Desert',
    3 => 'Ghost of Yotei',
    4 => 'Elden Ring',
    5 => 'Cyberpunk 2077',
    6 => 'The Witcher 3: Wild Hunt',
    7 => 'Call of Duty: Warzone',
    8 => 'EA Sports FC 25',
    9 => 'Forza Horizon 5',
    10 => 'Resident Evil 4',
    11 => 'Minecraft',
    12 => 'Grand Theft Auto V'
];

function searchIgdbGameByName($name)
{
    $client_id = "";
    $access_token = getIgdbAccessToken();

    if (!$access_token) {
        return null;
    }

    $safeName = addslashes($name);

    $query = "
        fields id, name, first_release_date;
        search \"$safeName\";
        limit 5;
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

    if (!is_array($data) || empty($data)) {
        return null;
    }

    return $data;
}

echo "<pre>";

foreach ($games as $localId => $title) {
    $matches = searchIgdbGameByName($title);

    echo "Local game_id: {$localId}\n";
    echo "Search title: {$title}\n";

    if (!$matches) {
        echo "No IGDB matches found.\n\n";
        continue;
    }

    foreach ($matches as $index => $match) {
        $release = !empty($match['first_release_date'])
            ? date('Y-m-d', $match['first_release_date'])
            : 'TBA';

        echo ($index + 1) . ". IGDB ID: {$match['id']} | {$match['name']} | {$release}\n";
    }

    $best = $matches[0];
    echo "Suggested SQL:\n";
    echo "UPDATE games SET igdb_id = {$best['id']} WHERE game_id = {$localId};\n\n";
}

echo "</pre>";