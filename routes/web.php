<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TokenController;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');

Route::get('/tasks/{number}', [TaskController::class, 'show'])->whereNumber('number')->name('tasks.show');

Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::delete('/feedback', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::patch('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

    Route::post('/tokens', [TokenController::class, 'store'])->name('tokens.store');

    Route::get('/admin', function () {
        return view('admin', [
            'users' => User::withCount('notes')->orderBy('id')->get(),
            'notes' => Note::with('user')->latest()->get(),
        ]);
    })->can('view-admin')->name('admin');
});
