<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Tag;
use App\User;

class BlogController extends Controller
{
    public function getSingle($slug) {
    	$post = Post::where('slug','=',$slug)->first();

    	$post->hits = $post->hits + 1;

        $post->save();

        $populars = Post::orderBy('hits', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->take(10)
                                ->get();
        $bloggers = User::orderBy('id', 'desc')->first();                        
        $totalpost = Post::orderBy('id', 'desc')->first();                      

        
                       
        return view('blog.single')
    				->withPost($post)
                    ->withPopulars($populars)
                    ->withBloggers($bloggers)
                    ->withTotalpost($totalpost);	
    }
}
