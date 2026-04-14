<?php
require_once 'includeEnv.php';

class IgdbApi
{
    private string $clientId;
    private string $clientSecret;
    private string $cacheFile;

    public function __construct()
    {
        $this->clientId = getenv('IGDB_CLIENT_ID') ?: '';
        $this->clientSecret = getenv('IGDB_CLIENT_SECRET') ?: '';
        $this->cacheFile = __DIR__ . '/token.json';
    }

    private function request(string $url, string $query = '', array $headers = []): ?array
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($query) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log('cURL error: ' . curl_error($ch));
            curl_close($ch);
            return null;
        }

        curl_close($ch);
        return json_decode($response, true);
    }

    private function getAccessToken(): ?string
    {
        $needNewToken = true;
        if (file_exists($this->cacheFile)) {
            $data = json_decode(file_get_contents($this->cacheFile), true);
            if (!empty($data['access_token']) && time() < $data['expires_at']) {
                $needNewToken = false;
            }
        }

        if (!$needNewToken) {
            return $data['access_token'];
        }

        $url = 'https://id.twitch.tv/oauth2/token';
        $params = http_build_query([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'client_credentials'
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            error_log('cURL error: ' . curl_error($ch));
            curl_close($ch);
            return null;
        }
        curl_close($ch);

        $result = json_decode($response, true);
        if (empty($result['access_token'])) {
            file_put_contents('debug.log', "Failed to get token: " . $response, FILE_APPEND);
            return null;
        }

        $data = [
            'access_token' => $result['access_token'],
            'expires_at' => time() + $result['expires_in'] - 60
        ];

        file_put_contents($this->cacheFile, json_encode($data));

        return $data['access_token'];
    }

    public function getUpcomingGames(int $limit = 12): array
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return [];
        }

        $now = time();
        $query = "
            fields name, first_release_date, cover.url;
            where first_release_date != null & first_release_date > $now;
            sort first_release_date asc;
            limit $limit;
        ";

        $headers = [
            "Client-ID: {$this->clientId}",
            "Authorization: Bearer $accessToken",
            "Content-Type: text/plain"
        ];

        $data = $this->request('https://api.igdb.com/v4/games', $query, $headers);
        return is_array($data) ? $data : [];
    }

    public function getGameById(int $gameId): ?array
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return null;
        }

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

        $headers = [
            "Client-ID: {$this->clientId}",
            "Authorization: Bearer $accessToken",
            "Content-Type: text/plain"
        ];

        $data = $this->request('https://api.igdb.com/v4/games', $query, $headers);

        return (!empty($data[0])) ? $data[0] : null;
    }
}
