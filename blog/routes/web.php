<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Moderator\PostController as ModeratorPostController;



Route::group(['middleware' => [ 'auth', '']], function (){
    Route::resource('posts', PostController::class)->except(['index', 'show']);
    Route::resource('comments', CommentController::class);
    Route::get('like/{post}', [PostController::class, 'LikePost'])->name('likepost');

    Route::group([
        'middleware' => 'IsAdmin',
        'prefix' => 'admin', // url: posts
        'as' => 'admin.'    // routename: route('admin.posts.admin')
    ], function(){
        Route::resource('posts', AdminPostController::class);
    });
//
    Route::group([
        'middleware' => 'IsModerator',
        'prefix' => 'Moderator', // url: posts
        'as' => 'moderator.'    // routename: route('moderator.posts.moderator')
    ], function(){
        Route::resource('posts', ModeratorPostController::class);
    });
//


});

Route::resource('posts', PostController::class)->only(['index', 'show'])->middleware('changeloc');
Route::get('posts/category/{category}', [PostController::class, 'categoryPosts'])->name('posts.category');



Route::get('/', function (){
    return redirect()->route('posts.index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
