<?php

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

Route::view('/', 'welcome');

Route::get('dashboard', \App\Livewire\Dashboard\Index::class)->name('dashboard');

Route::get('posts', \App\Livewire\Posts\Index::class)->name('posts.index');
Route::get('posts/{post}', \App\Livewire\Posts\Show::class)->name('posts.show');

Route::get('makes', \App\Livewire\PostCategories\Index::class)->name('categories.index');
Route::get('makes/{category}', \App\Livewire\PostCategories\Show::class)->name('categories.show');

Route::get('users/{user}',\App\Livewire\Users\Show::class)->name('users.show');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
