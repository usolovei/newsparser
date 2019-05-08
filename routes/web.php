<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ArticleController@home');

Route::get('/articles', 'ArticleController@printArticles' );

Route::get('/{site}/news', 'ArticleController@printArticles');

Route::get('/articles/{slug}', 'ArticleController@showArticle');

Route::get('/recent', 'ArticleController@showRecentArticles');
