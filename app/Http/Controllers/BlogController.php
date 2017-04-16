<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Tag;
use App\User;
use App\Comment;
use App\Commentreply;
use App\Notification;
use Session;
use DB;

class BlogController extends Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function getSingle($slug) {
        

        // try-catch
        try {
            $users = User::all();
            $post = Post::where('slug','=',$slug)
                        ->where('isDeleted', '!=', '0')
                        ->where('isPublished', '=', 'publish')
                        ->first();

            // notification data
            if($post->hits == 100) {
                $notification = new Notification;
                $notification->type = 'hits';
                $notification->setter_id = $post->id;
                $notification->getter_id = $post->postedBy;
                $notification->post_title = $post->title;
                $notification->slug = $post->slug;
                $notification->save();
            }
            // notification data

            // count hit
            $post->hits = $post->hits + 1;
            $post->save();

            $populars = Post::orderBy('hits', 'desc')
                                    ->where('isDeleted', '!=', '0')
                                    ->take(5)
                                    ->get();
            $bloggers = User::orderBy('id', 'desc')->first();                        
            $totalpost = Post::orderBy('id', 'desc')->first();
            $totalcomment = Comment::orderBy('id', 'desc')->first();
            $recentcomments = Post::orderBy('commentsandrepliestcount_time', 'desc') // new version
                                    ->where('commentsandrepliestcount_time', '!=', '0000-00-00 00:00:00')
                                    ->where('isDeleted', '!=', '0')
                                    ->where('isPublished', '=', 'publish')
                                    ->take(10)
                                    ->get();
            $mostreads = Post::orderBy('commentsandrepliestcount', 'DESC') // new version
                                    ->where('commentsandrepliestcount', '!=', '0')
                                    ->where('isDeleted', '!=', '0')
                                    ->where('isPublished', '=', 'publish')
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
        catch (\Exception $e) {
            
            $message = $e->getMessage();
            
            Session::flash('errorException', $message); 

            return view('errors.404');

        }
        // try-catch

        
        
    }
}
