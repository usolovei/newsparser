<?php

namespace App\Http\Controllers;

use App\Modules\ParserClass;
use Illuminate\Http\Request;
use App\Article;
use App\Log;

class ParseController extends Controller
{
    public function start(){

        return view('articles.articles', compact('parserData'));
    }

    public function parse(){
        $parserClass = new ParserClass();

        $parserData = $parserClass->parserData();

        foreach($parserData as $parsedArticle){
            new Article($parsedArticle);
            new Log($parsedArticle);
//            $article->websiteURL = $parsedArticle['websiteURL'];
//            $article->title = $parsedArticle['title'];
//            $article->slug = $parsedArticle['slug'];
//            $article->date = $parsedArticle['date'];
//            $article->imageURL = 'some/url';
//            $article->tag = $parsedArticle['tag'];
//            $article->content = $parsedArticle['text'];
//
//            $article->save();
        }
    }

}
