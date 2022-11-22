<?php

use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/book', [BookController::class, 'show']);

// Route::post('/book', [BookController::class, 'store']);

// Route::get('/book/{slug}', [BookController::class, 'getSingle']);

// Route::post('/book/{slug}', [BookController::class, 'destroy']);

// Route::post('/book/edit/{slug}', [BookController::class, 'update']);

// Route::get('/add-book', function() {
//     return view('add');
// });

// Route::get('/edit-book/{slug}', function($slug) {
//     $book = Book::where('slug', $slug)->first();
//     return view('edit', ['book' => $book]);
// });

Route::resource('book', BookController::class);
