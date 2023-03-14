<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $articles = Article::query()->where('is_published', '=', true);

        if ($request->get('query')) {
            $query = $request->get('query');
            $articles = $articles->where('title', 'LIKE', "%$query%")->orWhere('short_text');
        }

        $articles = $articles->paginate(1)->withQueryString();

        return view('home', [
            'articles' => $articles
        ]);
    }

    public function signUp()
    {
        return view('signUp');
    }

    public function signIn()
    {
        return view('signIn');
    }
}
