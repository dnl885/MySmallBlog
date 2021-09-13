<?php

use App\Constants\RoleConstants;
use App\Http\Controllers\Admin\AppDefault\DefaultController;
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\AppPublic\AppDefault\HomeController;
use App\Http\Controllers\Admin\Content\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])
    ->name('index');

Route::group(['prefix'=>'posts/photo','middleware'=> ['auth','role:'.RoleConstants::ROLE_ADMIN.",".RoleConstants::ROLE_CONTENT_CREATOR]],function (){
    Route::post('upload',[PostsController::class,'storePhoto'])->name('posts.upload-photo');
    Route::delete('delete',[PostsController::class,'deletePhoto'])->name('posts.delete-photo');
});

Route::group(['prefix'=>'admin', 'middleware'=> ['auth']], function(){
    Route::get('/',[DefaultController::class,'index'])
        ->name('admin.index');

    Route::group(['prefix'=>'users','middleware'=>['role:'.RoleConstants::ROLE_ADMIN]],function (){
       Route::get('/',[UsersController::class,'index'])
           ->name('users.index');

       Route::post('/grant-role',[UsersController::class,'grantRole'])
           ->name('users.grant-role');
    });

    Route::group(['prefix'=>'posts','middleware'=>['role:'.RoleConstants::ROLE_ADMIN.",".RoleConstants::ROLE_CONTENT_CREATOR]],function(){
        Route::get('/',[PostsController::class,'index'])
            ->name('posts.index');

        Route::post('/',[PostsController::class,'store'])
            ->name('posts.store');

        Route::get('/create',[PostsController::class,'create'])
            ->name('posts.create');

        Route::get('/{post}/edit',[PostsController::class,'edit'])
            ->name('posts.edit');


        Route::delete('/{post}',[PostsController::class,'destroy'])
            ->name('posts.destroy');

        Route::put('/{post}',[PostsController::class,'update'])
            ->name('posts.update');
    });
});

Route::post('/post/{post}/comment',[HomeController::class,'postComment'])
    ->middleware('auth')
    ->name('post.comment');

Route::get('post/archive/{year}/{month}',[HomeController::class,'index'])
    ->name('posts.archive');

Route::get('post/{post}',[HomeController::class,'showPost'])
    ->name('posts.show');

require __DIR__.'/auth.php';
