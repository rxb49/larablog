<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;

class PublicController extends Controller
{
    public function home(){

        $article = Article::take(5)->orderBy('likes', 'desc')->get();
        return view('public.home', ['articles' => $article]);
    }
    public function index(User $user)
    {
        // On récupère les articles publiés de l'utilisateur
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->paginate(5);
        $categories = Category::all();
        // On retourne la vue
        return view('public.index', [
            'articles' => $articles,
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function indexByCategory(User $user, Request $request)
    {
        // On récupère les articles publiés de l'utilisateur
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->where('article_categories.id', $request)->paginate(5);
        $categories = Category::all();
        // On retourne la vue
        return view('public.index', [
            'articles' => $articles,
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function show(User $user, Article $article, Request $request)
    {
        // $user est l'utilisateur de l'article
        // $article est l'article à afficher
        
        $article = Article::where('user_id', $user->id)->where('draft', 0)->where('id', $article->id)->first();

        return view('public.show', [
            'article' => $article,
            'user' => $user
        ]);     
    }

    public function listauteur(){

        $auteurs = User::paginate(5);
        return view('public.listauteur', ['auteurs' => $auteurs]) ;
    }
}
