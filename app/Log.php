<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function saveLog($parsedArticle){
        $this->websiteURL = $parsedArticle['websiteURL'];
        $this->parsedURL = $parsedArticle['link'];
        $this->save();
    }

    protected $fillable = ['link', 'websiteURL'];
}
