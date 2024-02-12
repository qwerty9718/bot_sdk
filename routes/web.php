<?php

use App\Http\Controllers\BotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/show', [BotController::class,'getMe']);
Route::get('/set-hook', [BotController::class,'setWebhook']);
Route::post('/'. env('TELEGRAM_BOT_TOKEN'). '/webhook',[BotController::class,'webHookHandler']);
