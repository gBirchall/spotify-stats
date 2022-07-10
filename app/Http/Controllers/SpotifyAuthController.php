<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SpotifyAuthController extends Controller
{

    public function spotifyLogin()
    {

        return Socialite::driver('spotify')->scopes(['user-read-email', 'user-library-read', 'user-top-read'])->redirect();
    }

    public function spotifyCallback()
    {

        try {

            $user = Socialite::driver('spotify')->user();

            $userExists = User::where('email', $user->getEmail())->first();
            if (!$userExists) {

                $saveUser = User::updateOrCreate([
                    'spotify_id' => $user->getId(),
                ], [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName() . '@' . $user->getId()),
                    'spotify_id' => $user->getId(),
                    'spotify_refresh_token' => $user->refreshToken,
                ]);
            } else {
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'spotify_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }


            Auth::loginUsingId($saveUser->id);

            session()->put('spotify_token', $user->token);

            return redirect()->route('spotify.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function refreshToken()
    {

        $user = User::where('id', Auth::id())->first();
        $client = new Client();
        $baseUrl = 'https://accounts.spotify.com/api/token';
        $response = $client->request('POST', $baseUrl, [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET'))
            ],
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $user->spotify_refresh_token,
            ]
        ]);
        $token = json_decode($response->getBody()->getContents());
        session()->put('spotify_token', $token->access_token);
        return redirect()->route('spotify.index');
    }
}
