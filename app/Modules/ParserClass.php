<?php


namespace App\Modules;

use Symfony\Component\DomCrawler\Crawler;


//https://ain.ua/
//https://vc.ru/new
class ParserClass
{

    private $parseSettings = [
        'ain.ua' => [
            'URL' => 'https://ain.ua',
            'titleSelector' =>'h1',
            'dateSelector' =>'.post-date span',
            'tagSelector' =>'.post-category a',
            'textSelector' =>'.post-content > p',
            'articleLinkSelector' => '.post-item > .post-link',
            //'imgSelector' =>'',
        ],

        'vc.ru'  => [
            'URL' => 'https://vc.ru/new',
            'titleSelector' =>'h1',
            'dateSelector' =>'time',
            'tagSelector' =>'.entry_header__subsite__name',
            'textSelector' =>'.b-article p',
            'articleLinkSelector' => 'a.entry_content__link',
            //'imgSelector' =>'',
        ],
    ];

    public function getContent($link, $websiteURL, $settings){
        $html=file_get_contents($link);

        $crawlerArticle=new Crawler(null, $link);
        $crawlerArticle->addHtmlContent($html, 'UTF-8');

        $title = $crawlerArticle->filter($settings['titleSelector'])->text();
        $title = trim($title);

        $tmp = trim($link, "/");
        $tmp = explode("/", $tmp);
        $slug = $tmp [(count($tmp)-1)];

        $date = $crawlerArticle->filter($settings['dateSelector'])->text();


        $tag = $crawlerArticle->filter($settings['tagSelector'])->text();
        $tag = trim($tag);

        $content = $crawlerArticle->filter($settings['textSelector'])->each(function(Crawler $node){
                return $node->text();
        });

        $text ='';

        foreach ($content as $p){
            $text .= $p;
        }

//        $htmlMainPage=file_get_contents($websiteURL);
//        $crawlerMainPage=new Crawler(null, $websiteURL);
//        $crawlerMainPage->addHtmlContent($htmlMainPage, 'UTF-8');
//
//        $image = $crawlerMainPage->filter('.right-column > img')->attr('src');

        $content = [
            'link' => $link,
            'title' => $title,
            'date' => $date,
            'tag' => $tag,
            'text' => $text,
            //'image' => $image,
            'slug' => $slug,
            'websiteURL' => $websiteURL,
        ];

        return $content;
    }

    public function parserData($parsedLinks)
    {
        $articlesArray = [];

        foreach ($this->parseSettings as $websiteParseSettings){
            $websiteURL = $websiteParseSettings['URL'];

            $html=file_get_contents($websiteURL);

            $crawler = new Crawler(null, $websiteURL);
            $crawler->addHtmlContent($html, 'UTF-8');

            $articleLinksArray = $crawler->filter($websiteParseSettings['articleLinkSelector'])->each(function (Crawler $node){
                return $node->attr('href');
            });

            foreach($articleLinksArray as $link)
                if(!($parsedLinks->contains('parsedURL', $link))) {
                    $articlesArray[] = $this->getContent($link, $websiteURL, $websiteParseSettings);
                }
                };


        return $articlesArray;
    }



}
