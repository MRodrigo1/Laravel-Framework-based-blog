<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest();
        //$this->authorize('admin');
        return view('posts\index', [
                //'posts' => Post::latest('published_at')->with('category','author')->get(),
                'posts' => Post::latest()->filter(
                    request(['search', 'category','author'])
                    )->paginate(6)->withQueryString(),
        ]);
    }
    public function show(Post $post){
        return view('posts\show', [
            'post' => $post
    ]);
    }

}
