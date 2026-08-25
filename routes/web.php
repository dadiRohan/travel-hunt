<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

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

// Authentication Routes
Auth::routes();

// Home page - Show all travels
Route::get('/', [TravelController::class, 'index'])->name('travels.index');

// Travel Routes - Require authentication for create/store/edit/update/delete
Route::middleware(['auth'])->group(function () {
    // Create travel form
    Route::get('/travels/create', [TravelController::class, 'create'])->name('travels.create');
    
    // Store new travel
    Route::post('/travels', [TravelController::class, 'store'])->name('travels.store');
    
    // Edit travel form
    Route::get('/travels/{travel}/edit', [TravelController::class, 'edit'])->name('travels.edit');
    
    // Update travel
    Route::put('/travels/{travel}', [TravelController::class, 'update'])->name('travels.update');
    
    // Delete travel
    Route::delete('/travels/{travel}', [TravelController::class, 'destroy'])->name('travels.destroy');
    
    // Delete image from travel
    Route::delete('/travels-images/{imageId}', [TravelController::class, 'deleteImage'])->name('travels.delete-image');
    
    // Comments
    Route::post('/travels/{travel}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Likes
    Route::post('/travels/{travel}/like', [LikeController::class, 'toggle'])->name('likes.toggle');
});

// Show travel details
Route::get('/travels/{travel}', [TravelController::class, 'show'])->name('travels.show');

// Get likes count (can be public)
Route::get('/travels/{travel}/likes/count', [LikeController::class, 'count'])->name('likes.count');
