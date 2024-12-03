<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $content =$request->content;
        $articleId = $request->articleId;
        
        if (Auth::check()) {
            Comment::create([
                'content' => $content,
                'article_id' => $articleId,
                'user_id' => Auth::user()->id
            ]);
        }
        
        return redirect()->back();

    }
}
