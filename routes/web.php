<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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

    return view('posts', [  //  pass them into the view
        'posts' => Post::all()
    ]);
});

Route::get('posts/{post}', function ($slug) {
    //    Find a post by its slug and pass it to a view called "post"
    $post = Post::find($slug);

    return view('post', [
        'post' => $post
    ]);
})->where('post', '[A-z_\-]+');     //  route wildcard constraints
