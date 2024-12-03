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
        </div>

        <div>
            <div class="mt-4 p-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                <p class="text-gray-700 dark:text-gray-300">{{ $article->content }}</p>
            </div>
        </div>
    </div>

</x-guest-layout>

<form action="{{ route('comments.store') }}" method="post" class="mt-6">
        @csrf
        <input type="hidden" name="articleId" value="{{ $article->id }}">

        </form>