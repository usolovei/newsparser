<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function print(){
        $parserData = Article::all();
        return view('articles.articles', compact('parserData'));
    }
}
