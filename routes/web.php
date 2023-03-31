<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;


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

// "Hello World!!"表示画面
Route::get('sample', [SampleController::class, 'index']);

// Google検索結果一覧表示画面
Route::get('google_search_list', [GoogleSearchListController::class, 'index'])->name('google.index');
Route::post('/google_search_list', [GoogleSearchListController::class, 'create'])->name('google_search.create');
