<x-logged-layout>
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liste des articles publiés de {{ $user->name }}
        </h2>
    </div>

    <div>

        <div class="mt-6 max-w-xl mx-auto">
            <form method="GET" action="{{ 'public.indexByCategory' }}" class="mb-4">
                <label for="filter" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Filtrer les commentaires</label>
                <select 
                    name="filter" 
                    id="filter" 
                    class="w-full px-3 py-2 border rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-700"
                    placeholder="Recherchez un commentaire..."
                >
                    @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-700">
                    Filtrer
                </button>
            </form>
        </div>
        <!-- Articles -->

        @foreach ($articles as $article)
        <div>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold">{{ $article->title }}</h2>
                <p class="text-gray-700 dark:text-gray-300">{{ substr($article->content, 0, 30) }}...</p>
                
                <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="text-red-500 hover:text-red-700">Lire la suite</a>

                <div class="mt-2">
                    @foreach ($article->categories as $category)
                        <span class="inline-block bg-gray-200 text-gray-700 text-sm font-medium px-3 py-1 rounded-full dark:bg-gray-700 dark:text-gray-300 mr-2">
                            #{{ $category->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        @endforeach


    </div>
    {{ $articles->links() }}
</x-logged-layout>