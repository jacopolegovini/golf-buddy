<x-public-layout>
    <div class="flex flex-col items-center justify-center py-32 px-6 text-center">
        <p class="text-8xl font-bold text-green-600">⛳</p>
        <h1 class="text-4xl font-bold text-gray-800 mt-6 mb-4">Pagina non trovata</h1>
        <p class="text-gray-500 text-lg mb-8">
            La pagina che cerchi non esiste o è stata rimossa.
        </p>
        <a href="{{ route('home') }}"
           class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
            Torna alla home
        </a>
    </div>
</x-public-layout>
