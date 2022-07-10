<?php

namespace App\Http\Livewire;

use Spotify;

use GuzzleHttp\Client;
use Livewire\Component;
use Laravel\Socialite\Facades\Socialite;



class SpotifyStats extends Component
{
    public  array $topArtists;
    public  array $topTracks;
    public  string $term = 'short_term';


    public function spotifyGetRequest(string $endpoint, array $params = []): object
    {

        $client = new Client();
        $baseUrl = 'https://api.spotify.com/v1/me/';
        $response = $client->request('GET', $baseUrl . $endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('spotify_token')
            ],
            'query' => $params
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function getTopArtists(string $term = 'short_term'): array
    {

        return $this->spotifyGetRequest('top/artists', [
            'time_range' => $term
        ])->items;
    }

    public function getTopTracks(string $term = 'short_term'): array
    {

        return $this->spotifyGetRequest('top/tracks', [
            'time_range' => $term
        ])->items;
    }


    public function changeTerm(string $term): void
    {

        $this->term = $term;
        $this->topArtists = $this->getTopArtists($this->term);
        $this->topTracks = $this->getTopTracks($this->term);
    }



    public function mount(): void
    {

        $this->topArtists = $this->getTopArtists();
        $this->topTracks = $this->getTopTracks();
    }

    public function render()
    {

        return view('livewire.spotify-stats');
    }
}
