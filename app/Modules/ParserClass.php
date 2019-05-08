<?php


namespace App\Modules;

use Symfony\Component\DomCrawler\Crawler;

class ParserClass
{

    private $parseSettings = [
        'ain.ua' => [
            'URL' => 'https://ain.ua',
            'titleSelector' =>'h1',
            'dateSelector' =>'.post-date span',
            'tagSelector' =>'.post-category a',
            'textSelector' =>'.post-content > p, .post-content li',
            'articleLinkSelector' => '.post-item > .post-link',
            'imgSelector' =>'p > img',

            //Specify which pages to parse
            'pagesToParse' => ['', '/page/2', '/page/3'],

        ],

        'vc.ru'  => [
            'URL' => 'https://vc.ru/new',
            'titleSelector' =>'h1',
            'dateSelector' =>'time',
            'tagSelector' =>'.entry_header__subsite__name',
            'textSelector' =>'.b-article p',
            'articleLinkSelector' => 'a.entry_content__link',
            'imgSelector' =>'.image-wrapper-2 > .andropov_image img',


            //Specify which pages to parse '' means only mentioned above 'URL' will be parsed
            'pagesToParse' => [''],

        ],
    ];


    public function parserData($parsedLinks)
    {
        $articlesArray = [];

        foreach ($this->parseSettings as $websiteParseSettings) {

            foreach($websiteParseSettings['pagesToParse'] as $page){

                $websiteURL = $websiteParseSettings['URL'].$page;

                $html = file_get_contents($websiteURL);

                $crawler = new Crawler(null, $websiteURL);
                $crawler->addHtmlContent($html, 'UTF-8');

                $articleLinksArray = $crawler->filter($websiteParseSettings['articleLinkSelector'])->each(function (Crawler $node) {
                    return $node->attr('href');
                });


                $tmp = $this->getContentForEachLink($articleLinksArray,
                    $websiteURL,
                    $websiteParseSettings,
                    $parsedLinks);


                $articlesArray = array_merge($articlesArray, $tmp);
            }

        }

        return $articlesArray;
    }




    public function getContentForEachLink($articleLinksArray, $websiteURL, $websiteParseSettings, $parsedLinks)
    {
        $articlesArray = [];

        foreach ($articleLinksArray as $link) {
            if (!($parsedLinks->contains('parsedURL', $link))) {
                $articlesArray[] = $this->getContent($link, $websiteURL, $websiteParseSettings);
            }

        };

        return $articlesArray;
    }


    public function getContent($link, $websiteURL, $settings){
        $html=file_get_contents($link);

        $crawlerArticle=new Crawler(null, $link);
        $crawlerArticle->addHtmlContent($html, 'UTF-8');

        $title = $crawlerArticle->filter($settings['titleSelector'])->text();
        $title = trim($title);

        $URL = trim($link, "/");
        $URL = explode("/", $URL);
        $slug = $URL [(count($URL)-1)];
        $websiteName = $URL [2];

        $date = $crawlerArticle->filter($settings['dateSelector'])->text();


        $tag = $crawlerArticle->filter($settings['tagSelector'])->text();
        $tag = trim($tag);

        $content = $crawlerArticle->filter($settings['textSelector'])->each(function(Crawler $node){
                return $node->text();
        });

        $text = join('|', $content);


        $imgURLs = $crawlerArticle->filter($settings['imgSelector'])->each(function (Crawler $node) {
            return $node->image()->getUri();
        });

        $imgURL = join('|', $imgURLs);

        $content = [
            'link' => $link,
            'title' => $title,
            'date' => $date,
            'tag' => $tag,
            'text' => $text,
            'image' => $imgURL,
            'slug' => $slug,
            'websiteURL' => $websiteURL,
            'websiteName' => $websiteName,
        ];

        return $content;
    }







}
