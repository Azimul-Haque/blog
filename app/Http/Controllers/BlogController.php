<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Tag;
use App\User;
use App\Comment;
use App\Commentreply;
use DB;

class BlogController extends Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function getSingle($slug) {
        $users = User::orderBy('id', 'desc')->get();
    	$post = Post::where('slug','=',$slug)
                        ->where('isDeleted', '!=', '0')
                        ->where('isPublished', '=', 'publish')
                        ->first();

    	$post->hits = $post->hits + 1;

        $post->save();

        $populars = Post::orderBy('hits', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->take(10)
                                ->get();
        $bloggers = User::orderBy('id', 'desc')->first();                        
        $totalpost = Post::orderBy('id', 'desc')->first();
        $totalcomment = Comment::orderBy('id', 'desc')->first();
        $recentcomments = Comment::orderBy('id', 'desc')
                                ->take(10)
                                ->get();
        $mostreads = Comment::select('post_id', DB::raw('COUNT(post_id) AS occurrences'))
                                ->groupBy('post_id')
                                ->orderBy('occurrences', 'DESC')
                                ->take(5)
                                ->get(); 
        $totalcommentreply = Commentreply::orderBy('id', 'desc')->first();                

        
                       
        return view('blog.single')
                    ->withUsers($users)
    				->withPost($post)
                    ->withPopulars($populars)
                    ->withBloggers($bloggers)
                    ->withTotalpost($totalpost)
                    ->withTotalcomment($totalcomment)
                    ->withMostreads($mostreads)
                    ->withRecentcomments($recentcomments)
                    ->withTotalcommentreply($totalcommentreply);
    }
}
