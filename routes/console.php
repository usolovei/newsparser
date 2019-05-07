<?php

use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\ParseController;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('parse', function(){
    $this->comment('Parsing news...');
    $parse_tool = new ParseController();
    $parse_tool->parse();
    $this->comment('Success!');
})->describe('Initially parse news from specified websites.');
