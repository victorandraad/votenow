<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VoteController::class, 'enterRoom']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    Route::get('/rooms/{room}/add-question', [RoomController::class, 'addQuestionForm'])->name('rooms.add_question');
    Route::post('/rooms/{room}/add-question', [RoomController::class, 'addQuestion'])->name('rooms.store_question');
    Route::delete('/rooms/{room}', [RoomController::class, 'deleteRoom'])->name('rooms.destroy');
    Route::delete('/questions/{question}', [RoomController::class, 'deleteQuestion'])->name('questions.destroy');
    Route::delete('/options/{option}', [RoomController::class, 'deleteOption'])->name('options.destroy');
});

Route::post('/rooms/join', [RoomController::class, 'join'])->name('rooms.join');

// Add these routes outside of any middleware group
Route::get('/vote', [VoteController::class, 'enterRoom'])->name('votes.enter');
Route::post('/vote/join', [VoteController::class, 'joinRoom'])->name('votes.join');
Route::get('/vote/{code}', [VoteController::class, 'showRoom'])->name('votes.room');
Route::post('/vote/{question}', [VoteController::class, 'castVote'])->name('votes.cast');

Route::get('/results/{code}', [RoomController::class, 'seeResult'])->name('rooms.result');

require __DIR__.'/auth.php';
