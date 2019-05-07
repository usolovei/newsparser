<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    function __construct($parsedArticle){
        $this->websiteURL = $parsedArticle['websiteURL'];
        $this->title = $parsedArticle['title'];
        $this->slug = $parsedArticle['slug'];
        $this->date = $parsedArticle['date'];
        $this->imageURL = 'some/url';
        $this->tag = $parsedArticle['tag'];
        $this->content = $parsedArticle['text'];

        $this->save();

    }

    protected $fillable = ['link', 'title', 'slug', 'date', 'imageURL', 'tag', 'content'];
}
