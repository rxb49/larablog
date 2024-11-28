<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Articles -->
                    @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 text-center">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-500 text-white p-4 rounded-lg mt-6 mb-6 text-center">
                            {{ session('error') }}
                        </div>
                    @endif
                    @foreach ($articles as $article)
                    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-5 shadow-none transition-shadow duration-300 hover:shadow-lg hover:shadow-gray-400">

                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $article->title }}</h2>
                        <p class="font-normal text-gray-700 dark:text-gray-400">{{ substr($article->content, 0, 30) }}...</p>
                        </a>
                        <div class="text-right">
                            <a href="{{ route('articles.edit', $article->id) }}" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Modifier</a>
                        </div>
                        <br>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
    

</x-app-layout>
