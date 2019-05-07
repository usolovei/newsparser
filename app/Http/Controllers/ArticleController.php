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


    public function print($site=''){

        if(!strcmp($site,'')) {
            $parserData = Article::select('id','websiteName', 'title','slug', 'date' ,'imageURL', 'tag' )->get();
        }
        else{
            $parserData = Article::select('id','websiteName', 'title','slug', 'date' ,'imageURL', 'tag')->where('websiteName', $site)->get();
        }
        $websites = Log::distinct('websiteName')->pluck('websiteName');
        $websitePageURLs = [];

        foreach ($websites as $website){
            $tmp = explode('.', $website);
            $tuple[0] = '/'.$tmp[0].$tmp[1].'/news';
            $tuple[1] = $website;
            $websitePageURLs[] = $tuple;
        }

        return view('articles.articles', compact('parserData','websitePageURLs'));
    }

}
