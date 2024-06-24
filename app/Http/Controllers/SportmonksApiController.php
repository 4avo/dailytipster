<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SportmonksApiController extends Controller
{
    protected string $baseUrl = 'https://api.sportmonks.com/v3';
    protected string $apiToken = 'tnHMfHKugBzrCRa1rof9d9l5xwGnkGZq2XNHEkunS8eiGoJ7j9SrdCXC8LVq';

    // 1.2 Authentication
    protected function requestEndpoint(string $endpoint, array $query = [])
    {
        // We'll append the endpoint to the base URL
        $url = $this->baseUrl . $endpoint;

        // And we'll append the query parameters (like includes and filters)
        if(!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        // Authenticate using the token, send the request, and parse the JSON to an array
        return Http::withHeaders(['Authorization' => $this->apiToken])
            ->get($url)
            ->json();
    }

    // 2. Making your first request
    public function leagues(): JsonResponse
    {
        // https://api.sportmonks.com/v3/football/leagues
        $response = $this->requestEndpoint('/football/leagues');
        return new JsonResponse($response);
    }

    public function leaguesWithCurrentSeason(): JsonResponse
    {
        // https://api.sportmonks.com/v3/football/leagues?include=currentSeason
        $response = $this->requestEndpoint('/football/leagues', [
            'include' => 'currentSeason'
        ]);

        return new JsonResponse($response);
    }

    // 3. Request season teams
    public function seasonTeams(): JsonResponse
    {
        // https://api.sportmonks.com/v3/football/teams/seasons/21646
        $response = $this->requestEndpoint('/football/teams/seasons/21646');

        return new JsonResponse($response);
    }

    public function seasonTeamsWithPlayerNames(): JsonResponse
    {
        // https://api.sportmonks.com/v3/football/teams/seasons/21646?include=players.player:display_name
        $response = $this->requestEndpoint('/football/teams/seasons/21646', [
            'include' => 'players.player:display_name',
        ]);

        return new JsonResponse($response);
    }
}