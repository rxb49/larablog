<x-guest-layout>
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liste des auteurs
        </h2>
    </div>

    <div>
        <!-- Articles -->
        @foreach ($auteurs as $auteur)
        <div>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold">{{ $auteur->name }}</h2>
                <a href="{{ route('public.index', [$auteur->id,]) }}" class="text-red-500 hover:text-red-700">Voir les articles</a>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    {{ $auteurs->links() }}

</x-guest-layout>