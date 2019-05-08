<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function saveArticle($parsedArticle){

        $imgsURLs = $parsedArticle['image'];
        $imgs = explode('|', $imgsURLs);

        if($imgs) {
            $image = $imgs[0];
        }
        else{
            $image = "";
        }

        $this::firstOrCreate(
        ['slug' => $parsedArticle['slug']],
        [
            'websiteName' => $parsedArticle['websiteName'],
            'websiteURL' => $parsedArticle['websiteURL'],
            'title' => $parsedArticle['title'],
            'date' => $parsedArticle['date'],
            'imageURL' => $image,
            'tag' => $parsedArticle['tag'],
            'content' => $parsedArticle['text']
        ]
        );

    }

    protected $fillable = ['websiteName','websiteURL', 'title', 'slug', 'date', 'imageURL', 'tag', 'content'];
}
