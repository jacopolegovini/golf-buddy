<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('club');

        $myGames = Game::with(['club', 'creator', 'players'])
            ->whereHas('players', function ($query) {
                $query->where('users.id', auth()->id());
            })
            ->where('date', '>=', today())
            ->orderBy('date')
            ->orderBy('tee_time')
            ->get();

        $clubGames = collect();

        if ($user->club_id) {
            $clubGames = Game::with(['club', 'creator', 'players'])
                ->where('club_id', $user->club_id)
                ->where('date', '>=', today())
                ->whereNotIn('id', $myGames->pluck('id'))
                ->orderBy('date')
                ->orderBy('tee_time')
                ->take(5)
                ->get();
        }

        return view('dashboard', compact('user', 'myGames', 'clubGames'));
    }
}