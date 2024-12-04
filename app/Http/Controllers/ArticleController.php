<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    
    public function like()
    {
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)->first();
        $articles->likes++;
        $articles->save();

        return redirect()->back();
    }
}
