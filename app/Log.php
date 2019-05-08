<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function saveLog($parsedArticle){
        $this::firstOrCreate(
            ['parsedURL' => $parsedArticle['link']],
            [
                'websiteName' => $parsedArticle['websiteName'],
                'websiteURL' => $parsedArticle['websiteURL'],
            ]
        );

    }

    protected $fillable = ['link', 'websiteURL', 'websiteName', 'parsedURL'];
}
