<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\ToDoListController;
use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Services\Newsletter;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\File;
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

//Ver Posts
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

//Comentar em post so se for autorizado 
Route::post('/posts/{post:slug}/comments', [PostCommentsController::class,'store'])->middleware('auth');

//Registo de contas
Route::get('register', [RegisterController::class,'create'])->middleware('guest');
Route::post('register', [RegisterController::class,'store'])->middleware('guest');
//Sessões / login
Route::get('login', [SessionsController::class,'create'])->middleware('guest');
Route::post('sessions',[SessionsController::class,'store'])->middleware('guest');
Route::post('logout', [SessionsController::class,'destroy'])->middleware('auth');

//Mailchimp status
Route::post('newsletter' , NewsletterController::class);

//Criar Posts
// Route::get('admin/posts/create',[AdminPostController::class,'create'])->middleware('admin');
// Route::post('admin/posts',[AdminPostController::class,'store'])->middleware('admin');
// //Mostrar posts
// Route::get('admin/posts',[AdminPostController::class,'index'])->middleware('admin');
// //editar
// Route::get('admin/posts/edit/{post}',[AdminPostController::class,'edit'])->middleware('admin');
// Route::patch('admin/posts/{post}',[AdminPostController::class,'update'])->middleware('admin');
// Route::delete('admin/posts/{post}',[AdminPostController::class,'destroy'])->middleware('admin');

//Group
Route::middleware('can:admin')->group(function(){
    //Includes all, generates paths auto
    //Route::resource('admin/posts', AdminPostController::class)->except('show');
    Route::get('admin/posts/create',[AdminPostController::class,'create']);
    Route::post('admin/posts',[AdminPostController::class,'store']);
    Route::get('admin/posts',[AdminPostController::class,'index']);
    Route::get('admin/posts/edit/{post}',[AdminPostController::class,'edit']);
    Route::patch('admin/posts/{post}',[AdminPostController::class,'update']);
    Route::delete('admin/posts/{post}',[AdminPostController::class,'destroy']);
});

Route::get('toDoList', [ToDoListController::class,'show'])->middleware('auth');
// Route::get('categories/{category:slug}', function (Category $category) {
//         return view('posts', [
//                 'posts' => $category->posts,
//                 'currentCategory' => $category,
//                 'categories' => Category::all()
//         ]);
// });

// Route::get('authors/{author:username}', function (User $author) {
//         return view('posts.index', [
//                 'posts' => $author->posts,
//         ]);
// });

