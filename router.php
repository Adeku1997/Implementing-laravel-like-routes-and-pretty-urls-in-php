<?php

use Controllers\HomeController;
use Controllers\LoginController;
use Controllers\PostController;
use Controllers\RegistrationController;
use Controllers\CommentController;
use Packages\Route;

Route::get('home', HomeController::class, 'index');

Route::get('register', RegistrationController::class, 'showForm');
Route::post('register', RegistrationController::class, 'register');

Route::get('login', LoginController::class, 'showForm');
Route::post('login', LoginController::class, 'login');
Route::post('logout', LoginController::class, 'logout');

Route::get('show-post', PostController::class, 'show');

Route::get('post',PostController::class,'createPosts');
Route::post('post',PostController::class,'makePost');
Route::post('post/delete',PostController::class,'deletePost');

Route::get('update',PostController::class,'showUpdateForm');
Route::post('update',PostController::class,'updatePost');

Route::post('post-comments',CommentController::class,'makeComment');
Route::get('show-comments', CommentController::class, 'showComment');


