<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AskController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\StoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::namespace('\App\Http\Controllers')->name('story.')->group(function () {
    Route::get('stories/', [StoryController::class, 'index'])->name('index');
    Route::get('story/{id}', [StoryController::class, 'show'])->name('show');
    Route::post('spool-stories', [StoryController::class, 'spoolStories'])->name('spoolStories');
    Route::delete('story/{id}', [StoryController::class, 'destroy'])->name('destroy');
});

// Route::namespace('\App\Http\Controllers')->name('comment.')->group(function () {
//     Route::get('comments/', [ParcelController::class, 'index'])->name('index');
//     Route::get('comment/{id}', [ParcelController::class, 'show'])->name('show');
//     Route::post('spool-comments', [ParcelController::class, 'spoolComments'])->name('spoolComments');
//     Route::delete('comment/{id}', [ParcelController::class, 'destroy'])->name('destroy');
// });

Route::namespace('\App\Http\Controllers')->name('ask.')->group(function () {
    Route::get('asks/', [AskController::class, 'index'])->name('index');
    Route::get('asks/{id}', [AskController::class, 'show'])->name('show');
    Route::post('spool-asks-stories', [AskController::class, 'spoolAskStories'])->name('spoolAskStories');
});

Route::namespace('\App\Http\Controllers')->name('job.')->group(function () {
    Route::get('jobs/', [JobController::class, 'index'])->name('index');
    Route::get('jobs/{id}', [JobController::class, 'show'])->name('show');
    Route::post('spool-jobs', [JobController::class, 'spoolJobStories'])->name('spoolJobStories');
});

// Route::namespace('\App\Http\Controllers')->name('poll.')->group(function () {
//     Route::get('polls/', [ParcelController::class, 'index'])->name('index');
//     Route::get('poll/{id}', [ParcelController::class, 'show'])->name('show');
//     Route::post('spool-polls', [ParcelController::class, 'spoolPolls'])->name('spoolPolls');
//     Route::delete('poll/{id}', [ParcelController::class, 'destroy'])->name('destroy');
// });
