<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpotifyStatsController extends Controller {

    public function index() {

        return view('spotify.index', [
            'user' => auth()->user()
        ]);
    }
}
