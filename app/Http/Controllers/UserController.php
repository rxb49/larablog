<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        
        $data = $request->only(['title', 'content', 'draft', 'categories']);
        $data['user_id'] = Auth::user()->id;

        // Gestion du draft
        $data['draft'] = isset($data['draft']) ? 1 : 0;
        $data['title'] = htmlspecialchars($data['title']);
        $data['content'] = htmlspecialchars($data['content']);
        
        // On crée l'article
        $article = Article::create($data); // $Article est l'objet article nouvellement créé
        if ($request->has('categories')) {
            $article->categories()->sync($request->input('categories'));
        }
        // Exemple pour ajouter la catégorie 1 à l'article
        // $article->categories()->sync(1);

        // Exemple pour ajouter des catégories à l'article
        // $article->categories()->sync([1, 2, 3]);

        // Exemple pour ajouter des catégories à l'article en venant du formulaire
        // $article->categories()->sync($request->input('categories'));

        // On redirige l'utilisateur vers la liste des articles
        return redirect()->route('dashboard');
    }

    public function index()
    {
        // On récupère l'utilisateur connecté.
        $user = Auth::user();
        $categories = Category::all();
        $articles = Article::where('user_id', $user->id)->paginate(5);

        // On retourne la vue.
        return view('dashboard', ['articles' => $articles, 'categories' => $categories]);
    }

    public function edit(Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', 'Vous ne pouvez pas modifier cet article !');

        }
        $categories = Category::all();

        // On retourne la vue avec l'article
        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            abort(403);
        }

        // On récupère les données du formulaire
        $data = $request->only(['title', 'content', 'draft', 'categories']);

        // Gestion du draft
        $data['draft'] = isset($data['draft']) ? 1 : 0;
        $data['title'] = htmlspecialchars($data['title']);
        $data['content'] = htmlspecialchars($data['content']);
        // On met à jour l'article
        $article->update($data);

        if (isset($data['categories']) && is_array($data['categories'])) {
            $article->categories()->sync($data['categories']);
        }

        // On redirige l'utilisateur vers la liste des articles (avec un flash)
        return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
    }

    public function remove(Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', 'Vous ne pouvez pas supprimer cet article !');

        }
        $user = Auth::user();

        $articles = Article::where('user_id', $user->id)->paginate(5);

        $article = Article::find($article->id);
        $article->delete();

        // On retourne la vue avec l'article
        return redirect()->route('dashboard')->with('success', 'Article supprimer !');
    }
}
