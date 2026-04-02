<x-public-layout>

    {{-- Hero --}}
    <div class="text-center py-20 px-6">
        <h1 class="text-4xl font-bold text-green-700 mb-4">Trova un compagno di gioco</h1>
        <p class="text-gray-500 text-lg mb-8">
            Registrati, scegli il tuo club e unisciti alle prossime partite.
        </p>
        <a href="{{ route('register') }}"
           class="bg-green-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-green-700">
            Inizia ora
        </a>
    </div>

    {{-- Club disponibili --}}
    <div class="max-w-5xl mx-auto px-6 pb-16">
        <h2 class="text-2xl font-semibold mb-6">Club disponibili</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($clubs as $club)
                <div class="bg-white shadow rounded-lg p-5">
                    <h3 class="text-lg font-semibold text-green-700">{{ $club->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $club->city }}</p>
                    <p class="text-gray-500 text-sm">{{ $club->holes }} buche</p>
                    <p class="mt-3 text-sm font-medium">
                        {{ $club->games_count }}
                        {{ $club->games_count == 1 ? 'partita' : 'partite' }} in programma
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Prossime partite --}}
    <div class="max-w-5xl mx-auto px-6 pb-20">
        <h2 class="text-2xl font-semibold mb-6">Prossime partite</h2>
        @forelse($upcomingGames as $game)
            <div class="bg-white shadow rounded-lg p-5 mb-4 flex justify-between items-center">
                <div>
                    <p class="font-semibold">{{ $game->club->name }}</p>
                    <p class="text-gray-500 text-sm">
                        {{ $game->date->translatedFormat('j F Y') }} alle {{ $game->tee_time }} —
                        {{ $game->players->count() }}/{{ $game->max_players }} giocatori
                    </p>
                </div>
                <a href="{{ route('login') }}" class="text-green-600 hover:underline text-sm">
                    Accedi per unirti →
                </a>
            </div>
        @empty
            <p class="text-gray-500">Nessuna partita in programma al momento.</p>
        @endforelse
    </div>
</x-public-layout>
