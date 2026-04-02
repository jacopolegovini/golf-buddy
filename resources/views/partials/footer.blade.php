<footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col sm:flex-row justify-between items-center gap-4">
        <span class="text-xl font-bold text-green-700">⛳ Golf Buddy</span>
        <p class="text-gray-500 text-sm text-center">
            Crato con ❤️ da <span class="font-medium text-gray-700">Jacopo</span> —
            {{ now()->year }}
        </p>
        <a class="flex items-center gap-3" href="https://github.com/jacopolegovini">
            <img src="{{ asset('github_logo_icon.jpg') }}" alt="github" class="w-6 h-6">
            <span class="text-gray-500 text-sm">GitHub</span>
        </a>
    </div>
</footer>
