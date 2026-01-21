<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;

Route::get('/register',[AuthController::class,'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login',[AuthController::class, 'showLogin'] )->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/questions',[QuestionController::class,'index'])->name('questions.index');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::post('/questions/{id}/vote', [QuestionController::class, 'vote'])->name('questions.vote');
    Route::post('/questions/{id}/follow', [QuestionController::class, 'follow'])->name('questions.follow');
    Route::get('/questions/{question}/answer', [AnswerController::class, 'create'])
    ->name('answers.create');
    Route::post('/questions/{question}/answer', [AnswerController::class, 'store'])
    ->name('answers.store');
    Route::post('/answers/{answer}/vote', [AnswerController::class, 'vote'])
    ->name('answers.vote');
    Route::post('/follow/{type}/{id}', [FollowController::class, 'toggle'])
    ->name('follow.toggle');
    Route::get('/questions/{id}/answers', [QuestionController::class, 'answer'])
    ->name('questions.answers');
    Route::get('/followers',[FollowController::class,'follow'])->name('follow');
    Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show');
});
?>
