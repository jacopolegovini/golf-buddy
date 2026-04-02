<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Partite disponibili') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('games.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Crea nuova partita
                </a>
            </div>
            <form method="GET" action="{{ route('games.index') }}" class="mb-6">
                <div class="flex gap-3 items-center">
                    <select name="club_id" class="border rounded px-3 py-2">
                        <option value="">Tutti i club</option>
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}"
                                {{ request('club_id') == $club->id ? 'selected' : '' }}>
                                {{ $club->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                            class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                        Filtra
                    </button>
                    @if(request('club_id'))
                        <a href="{{ route('games.index') }}" class="text-gray-500 hover:underline">
                            Rimuovi filtro
                        </a>
                    @endif
                </div>
            </form>

            @forelse($games as $game)
                <div class="bg-white shadow rounded-lg p-6 mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $game->club->name }}</h3>
                            <p class="text-gray-600">{{ $game->date->translatedFormat('j F Y') }} alle {{ $game->tee_time }}</p>
                            <p class="text-gray-500 text-sm">
                                Creata da {{ $game->creator->name }} —
                                {{ $game->players->count() }}/{{ $game->max_players }} giocatori
                            </p>
                        </div>
                        <a href="{{ route('games.show', $game) }}"
                           class="text-green-600 hover:underline">
                            Vedi dettagli →
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Nessuna partita disponibile al momento.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
