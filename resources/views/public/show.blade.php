<div class="text-xl hover:underline font-bold ml-10 mt-10">
        <a href="{{ route('public.index', $article->user->id) }}" class="text-xl hover:underline font-bold ml-10"> ← Retour sur les articles</a>
    </div>
<x-guest-layout>

    <div class="pt-6 px-4">

        <div class="text-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $article->title }}
            </h2>
        </div>

        <div class="text-gray-500 text-sm mt-2">
            Publié le {{ $article->created_at->format('d/m/Y') }} par <a href="{{ route('public.index', $article->user->id) }}">{{ $article->user->name }}</a>
        </div><br>
            @foreach ($article->categories as $category)
                <span class="inline-block bg-gray-200 text-gray-700 text-sm font-medium px-3 py-1 rounded-full dark:bg-gray-700 dark:text-gray-300 mr-2">
                    #{{ $category->name }}
                    </span>
            @endforeach
        <div>
            <div class="mt-4 p-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                <p class="text-gray-700 dark:text-gray-300">{{ $article->content }}</p>
            </div>
        </div>
    </div>
    <h1 class="text-gray-700 dark:text-gray-300 font-semibold mb-2">Commentaires :</h1>
    @if ($article->comments->isEmpty())
        <div class="text-center text-gray-500 dark:text-gray-400 mt-6">
            <p>Aucun commentaire publié pour cet article.</p>
        </div>
        @else
            @foreach ($article->comments as $comment)
                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md border border-gray-300 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $comment->content }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        Publié le {{ $comment->created_at->format('d/m/Y à H:i') }}
                    </p>
                </div>
            @endforeach
    @endif

    @if (Route::has('login'))

        @auth
        <form action="{{ route('comments.store') }}" method="post" class="mt-6 max-w-xl mx-auto bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-lg">
            @csrf
            <input type="hidden" name="articleId" value="{{ $article->id }}">
            
            <div class="mb-4">
                <label for="content" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Ajouter un commentaire</label>
                <textarea 
                    id="content" 
                    name="content" 
                    class="w-full h-24 px-3 py-2 border rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-700 resize-none"
                    placeholder="Écrivez votre commentaire ici..."
                    required
                ></textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-700">
                    Publier le commentaire
                </button>
            </div>
        </form>
        @endauth
    @endif
    @guest
        <div class="mt-6 max-w-xl mx-auto text-center bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-lg">
            <p class="text-gray-700 dark:text-gray-300">
                Vous devez être connecté pour laisser un commentaire. 
                <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Connectez-vous ici</a>.
            </p>
        </div>
    @endguest
    



</x-guest-layout>



