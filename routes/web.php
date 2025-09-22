<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/role/{role}', [RoleController::class, 'selectRole'])->name('role.select');
});


Route::middleware('admin')->group(function () {

   Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::put('/admin/posts/{post}/approve', [AdminController::class, 'approvePost']);
    Route::put('/admin/posts/{post}/reject', [AdminController::class, 'rejectPost']);
    Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost']);
});



Route::middleware('user')->group(function () {
 Route::get('/feed', [UserController::class, 'feed'])->name('user.feed');
    Route::post('/posts/{id}/like', [UserController::class, 'likePost']);
    Route::post('/comments/{id}/like', [UserController::class, 'likeComment']);
    Route::post('/posts/{id}/favourite', [UserController::class, 'addFavourite']);
    Route::post('/comments', [UserController::class, 'storeComment']);
});

Route::middleware('member')->group(function () {
    Route::get('/posts/create', [MemberController::class, 'createPost'])->name('member.create_post');
    Route::post('/posts', [MemberController::class, 'storePost'])->name('member.store_post');
   
});

require __DIR__.'/auth.php';
