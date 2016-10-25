<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Tag;

class BlogController extends Controller
{
    public function getSingle($slug) {
    	$post = Post::where('slug','=',$slug)->first();

    	$post->hits = $post->hits + 1;

        $post->save();

    	return view('blog.single')
    		->withPost($post);
    }
}
