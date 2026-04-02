<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Game;

class HomeController extends Controller
{
    public function index()
    {
        $clubs = Club::withCount(['games' => function ($query) {
            $query->where('date', '>=', today());
        }])->orderBy('name')->get();

        $upcomingGames = Game::with(['club', 'creator', 'players'])
            ->where('date', '>=', today())
            ->orderBy('date')
            ->orderBy('tee_time')
            ->take(5)
            ->get();

        return view('home', compact('clubs', 'upcomingGames'));
    }
}