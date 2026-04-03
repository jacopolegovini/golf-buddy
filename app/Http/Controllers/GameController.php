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
    public function index(Request $request)
    {
        $clubs = Club::orderBy('name')->get();

        $games = Game::with(['club', 'creator', 'players'])
        ->where('date', '>=', today())
        ->when($request->club_id, function ($query) use ($request) {
            $query->where('club_id', $request->club_id);
        })
        ->orderBy('date')
        ->orderBy('tee_time')
        ->get();

        return view('games.index', compact('games', 'clubs'));
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
        $game->players()->attach(auth()->id());

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
    public function destroy(Game $game)
    {
        if (auth()->id() !== $game->user_id) {
            return redirect()->route('games.index')
                            ->with('error', 'Non sei autorizzato a cancellare questa partita.');
        }

        $game->delete();

        return redirect()->route('games.index')
                        ->with('success', 'Partita cancellata.');
    }

    public function join(Game $game)
    {
        if (auth()->id() === $game->user_id) {
            return back()->with('error', 'Non puoi iscriverti alla tua stessa partita.');
        }

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
