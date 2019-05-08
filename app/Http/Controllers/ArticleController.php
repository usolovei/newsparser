<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Log;

class ArticleController extends Controller
{
    public function home(){

        return view('welcome');
    }
    /*
     *
     *
     *
     * */
    public function printArticles($site=''){

        if(!(strcmp($site,''))) {
            $parserData = Article::select('id','websiteName', 'title','slug', 'date' ,'imageURL', 'tag' )->paginate(4);
        }
        else{
            $parserData = Article::select('id','websiteName', 'title','slug', 'date' ,'imageURL', 'tag')->where('websiteName', $site)->orderBy('created_at', 'desc')->paginate(4);
        }
        $websites = Log::distinct('websiteName')->pluck('websiteName');
        $websitePageURLs = [];

        foreach ($websites as $website){
            $tuple[0] = '/'.$website.'/news';
            $tuple[1] = $website;
            $websitePageURLs[] = $tuple;
        }

        return view('articles.articles', compact('parserData','websitePageURLs'));
    }
    /*
     *
     *
     *
     *
     * */
    public function showArticle($slug){
        $article = Article::where('slug', $slug)->first();
        $content = explode('|', $article['content']);

        return view('articles.showArticle', compact('article', 'content'));
    }
    /*
     *
     *
     *
     *
     * */
    public function showRecentArticles(){
        $parserData = Article::select('id','websiteName', 'title','slug', 'date' ,'imageURL', 'tag' )->orderBy('created_at', 'desc')->paginate(4);
        return view('articles.recent', compact('parserData'));
    }

}
