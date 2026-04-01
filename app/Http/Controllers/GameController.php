<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Club;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::with(['club', 'creator', 'players'])->get();
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clubs = Club::orderBy('name')->get();
        return view('games.create', compact('clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'club_id'     => 'required|exists:clubs,id',
        'date'        => 'required|date|after_or_equal:today',
        'tee_time'    => 'required',
        'max_players' => 'required|integer|min:2|max:4',
        'notes'       => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        $game = Game::create($validated);

        return redirect()->route('games.show', $game)
                        ->with('success', 'Partita creata con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        $game->load(['club', 'creator', 'players']);
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function join(Game $game)
    {
        if ($game->players->count() >= $game->max_players) {
            return back()->with('error', 'Partita al completo.');
        }

        $game->players()->attach(auth()->id());

        return redirect()->route('games.show', $game)
                        ->with('success', 'Ti sei iscritto alla partita!');
    }

    public function leave(Game $game)
    {
        $game->players()->detach(auth()->id());

        return redirect()->route('games.show', $game)
                        ->with('success', 'Hai abbandonato la partita.');
    }
}