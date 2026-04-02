<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ciao, {{ auth()->user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Link rapido --}}
            <div>
                <a href="{{ route('games.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Crea nuova partita
                </a>
            </div>

            {{-- Le mie partite --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Le mie prossime partite</h3>

                @forelse($myGames as $game)
                    <div class="flex justify-between items-center py-3 border-b last:border-0">
                        <div>
                            <p class="font-medium">{{ $game->club->name }}</p>
                            <p class="text-gray-500 text-sm">
                                {{ $game->date->translatedFormat('j F Y') }} alle {{ $game->tee_time }} —
                                {{ $game->players->count() }}/{{ $game->max_players }} giocatori
                            </p>
                        </div>
                        <a href="{{ route('games.show', $game) }}"
                           class="text-green-600 hover:underline text-sm">
                            Vedi →
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500">Non sei iscritto a nessuna partita futura.</p>
                @endforelse
            </div>

            {{-- Partite nel mio club --}}
            @if(auth()->user()->club_id)
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        Prossime partite a {{ auth()->user()->club->name }}
                    </h3>

                    @forelse($clubGames as $game)
                        <div class="flex justify-between items-center py-3 border-b last:border-0">
                            <div>
                                <p class="font-medium">{{ $game->date->translatedFormat('j F Y') }} alle {{ $game->tee_time }}</p>
                                <p class="text-gray-500 text-sm">
                                    Creata da {{ $game->creator->name }} —
                                    {{ $game->players->count() }}/{{ $game->max_players }} giocatori
                                </p>
                            </div>
                            <a href="{{ route('games.show', $game) }}"
                               class="text-green-600 hover:underline text-sm">
                                Vedi →
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500">Nessuna altra partita in programma nel tuo club.</p>
                    @endforelse
                </div>
            @else
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-gray-500">
                        Non hai un club di appartenenza.
                        <a href="{{ route('profile.edit') }}" class="text-green-600 hover:underline">
                            Aggiungilo dal tuo profilo →
                        </a>
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
