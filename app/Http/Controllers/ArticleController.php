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

        if(!(strcmp($site,''))) {
            $parserData = Article::select('id','websiteName', 'title','slug', 'date' ,'imageURL', 'tag' )->paginate(5);
        }
        else{
            $parserData = Article::select('id','websiteName', 'title','slug', 'date' ,'imageURL', 'tag')->where('websiteName', $site)->paginate(5);
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

}
