<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dettaglio partita
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-1">{{ $game->club->name }}</h3>
                <p class="text-gray-500 text-sm mb-6">Creata da {{ $game->creator->name }}</p>

                <div class="mb-4">
                    <span class="font-semibold">Data:</span> {{ $game->date->translatedFormat('j F Y') }}
                </div>
                <div class="mb-4">
                    <span class="font-semibold">Tee time:</span> {{ $game->tee_time }}
                </div>
                <div class="mb-4">
                    <span class="font-semibold">Giocatori:</span>
                    {{ $game->players->count() }}/{{ $game->max_players }}
                </div>

                @if($game->notes)
                    <div class="mb-6">
                        <span class="font-semibold">Note:</span> {{ $game->notes }}
                    </div>
                @endif

                <div class="mb-6">
                    <span class="font-semibold">Iscritti:</span>
                    @if($game->players->isEmpty())
                        <span class="text-gray-500"> nessuno ancora</span>
                    @else
                        <ul class="mt-2 list-disc list-inside">
                            @foreach($game->players as $player)
                                <li>{{ $player->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Azioni --}}
                @if(auth()->id() !== $game->user_id)
                    @if($game->players->contains(auth()->id()))
                        <form method="POST" action="{{ route('games.leave', $game) }}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                Abbandona partita
                            </button>
                        </form>
                    @elseif($game->players->count() < $game->max_players)
                        <form method="POST" action="{{ route('games.join', $game) }}">
                            @csrf
                            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Unisciti alla partita
                            </button>
                        </form>
                    @else
                        <p class="text-red-500">Partita al completo</p>
                    @endif
                @endif

                @if(auth()->id() === $game->user_id)
                    <form method="POST" action="{{ route('games.destroy', $game) }}" class="mt-4"
                        onsubmit="return confirm('Sei sicuro di voler cancellare questa partita?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Cancella partita
                        </button>
                    </form>
                @endif

                <div class="mt-4">
                    <a href="{{ route('games.index') }}" class="text-gray-500 hover:underline">
                        ← Torna alla lista
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
