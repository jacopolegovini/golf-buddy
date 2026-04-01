<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crea nuova partita
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form method="POST" action="{{ route('games.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Club</label>
                        <select name="club_id" class="w-full border rounded px-3 py-2">
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Data</label>
                        <input type="date" name="date" class="w-full border rounded px-3 py-2"
                               value="{{ old('date') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Orario di partenza (tee time)</label>
                        <input type="time" name="tee_time" class="w-full border rounded px-3 py-2"
                               value="{{ old('tee_time') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Numero massimo di giocatori</label>
                        <input type="number" name="max_players" min="2" max="4"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('max_players', 4) }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-1">Note (opzionale)</label>
                        <textarea name="notes" rows="3"
                                  class="w-full border rounded px-3 py-2">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        Crea partita
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
