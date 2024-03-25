<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\CommentController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('chirps', ChirpController::class)
	->only(['index', 'store', 'edit', 'update', 'destroy'])
	->middleware(['auth', 'verified']);

Route::post('/comments/{comment}', [CommentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('comments.destroy');
Route::get('/comments/{chirp}', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comments.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/chirps/recent', [ChirpController::class, 'recent'])->name('recent');
    Route::get('/chirpers',[ProfileController::class, 'index'])->name('chirpers.index');
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('profile/{user_id}/follow', [ProfileController::class, 'follow'])->name('profile.follow');
    Route::post('profile/{user_id}/unfollow', [ProfileController::class, 'unfollow'])->name('profile.unfollow');
});



require __DIR__.'/auth.php';
