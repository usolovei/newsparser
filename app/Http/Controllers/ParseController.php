<?php

namespace App\Http\Controllers;

use App\Modules\ParserClass;
use Illuminate\Http\Request;
use App\Article;
use App\Log;

class ParseController extends Controller
{

    public function parse(){
        $parserClass = new ParserClass();

        $alreadyParsed = Log::select('parsedURL')->get();
        $parserData = $parserClass->parserData($alreadyParsed);


        foreach($parserData as $parsedArticle){

            $article = new Article();
            $article->saveArticle($parsedArticle);
            $log = new Log();
            $log->saveLog($parsedArticle);
        }
    }

}
