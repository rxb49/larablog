
<x-logged-layout>
<div class="text-xl hover:underline font-bold mt-10">
        <a href="{{ route('public.index', $article->user->id) }}" class="text-xl hover:underline font-bold ml-10"> ← Retour sur les articles</a>
    </div>
    <div class="pt-6 px-4">
        <div class="flex justify-between items-center">
            <!-- Titre à gauche -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $article->title }}
            </h2>

            <!-- Bouton Like à droite -->
            @auth
                <a href="{{ route('article.like', $article->id) }}" 
                class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61" clip-rule="evenodd" />
                    </svg>
                    <span>{{$article->likes}}</span>
                </a>
            @endauth
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
    



</x-logged-layout>



