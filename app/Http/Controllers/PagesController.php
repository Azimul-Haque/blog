<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator, Input, Redirect, Session, DB;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use App\Comment;
use App\Commentreply;
use Mail;



class PagesController extends Controller {

    public function __construct(){
        parent::__construct();
    }
  
	public function getIndex() {
        $users = User::orderBy('id', 'desc')->get();
		$posts = Post::orderBy('created_at', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->where('isPublished', '=', 'publish')
                                ->paginate(15); // it will be 15
        $populars = Post::orderBy('hits', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->where('isPublished', '=', 'publish')
                                ->take(10)
                                ->get();                        
        $bloggers = User::orderBy('id', 'desc')->first();                        
        $totalpost = Post::orderBy('id', 'desc')->first();
        $totalcomment = Comment::orderBy('id', 'desc')->first();
        $featured = Post::where('featured', '=', 'YES')->first();
        $recentcomments = Comment::orderBy('id', 'desc')
                                ->take(10)
                                ->get();
        $mostreads = Comment::select('post_id', DB::raw('COUNT(post_id) AS occurrences'))
                                ->groupBy('post_id')
                                ->orderBy('occurrences', 'DESC')
                                ->take(5)
                                ->get();
        $totalcommentreply = Commentreply::orderBy('id', 'desc')->first();                                           
        
                       
        return view('pages.welcome')
                    ->withUsers($users)
        			->withPosts($posts)
                    ->withPopulars($populars)
                    ->withBloggers($bloggers)
                    ->withTotalpost($totalpost)
                    ->withTotalcomment($totalcomment)
                    ->withFeatured($featured)
                    ->withMostreads($mostreads)
                    ->withRecentcomments($recentcomments)
                    ->withTotalcommentreply($totalcommentreply);
	}  

	public function getAbout() {
      
		return view('pages.about');
	}  

    public function getContact() {
       
        return view('pages.contact');
    }

    public function postContact(Request $request) {
        $this->validate($request, array(
            'email'       => 'required|email',
            'subject'     => 'required' ,
            'message'     => 'required|min:5',
            'g-recaptcha-response' => 'required',      
       ));

       $data = ['email'   => $request->email,
                'subject'   => $request->subject,
                'bodyMessage'   => $request->message];

       Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->from($data['email']);
            $message->sender('blog@HoTg.org', 'John Doe');
        
            $message->to('blog@humansofthakurgaon.org');
        
            $message->cc('orbachinujbuk@gmail.com', 'John Doe');
            //$message->bcc('john@johndoe.com', 'John Doe');
        
            $message->replyTo($data['email']);
            $message->subject($data['subject']);        
            $message->priority(3);
        
            //$message->attach('pathToFile');
        });
        Session::flash('success', 'আপনার বার্তা আমাদের কাছে পৌঁছেছে');

        //redirect
        return view('pages.contact');
	}

	public function getCategoryBased() {
        $categories = Category::all();
        $tags = Tag::all();
        return view('pages.category_based')
        		->withCategories($categories)
        		->withTags($tags);
    }

    public function getCategoryTags($name) {
        $users = User::orderBy('id', 'desc')->get();
        $tag = Tag::where('name', '=', $name)->first();
        $taglist = Tag::all();

        return view('pages.categories_tags')
                ->withUsers($users)
        		->withTag($tag)
        		->withTaglist($taglist);
    }    

    public function getCategoryCategories($name) {
        $users = User::orderBy('id', 'desc')->get();
        $category = Category::where('name', '=', $name)->first();
        $categorylist = Category::all();

        return view('pages.categories_categories')
                ->withUsers($users)
        		->withCategory($category)
        		->withCategorylist($categorylist);
    }

    public function getAuthor($author) {
        $users = User::orderBy('id', 'desc')->get();
        $user = User::where('name', '=', $author)->first();
        $posts = Post::orderBy('created_at', 'desc')
                                ->where('postedBy', '=', $user->id)
                                ->where('isDeleted', '!=', '0')
                                ->where('isPublished', '=', 'publish')
                                ->get(); // it will be 15
                       
        return view('pages.author')
            ->withUsers($users)
            ->withUser($user)
            ->withPosts($posts);
    }

    public function getAllBloggersAtHomePage () {
        $users = User::orderBy('id', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->get(); // it will be 15

        return view('pages.allbloggers')
                    ->withUsers($users)
                    ->withPosts($posts);

    }

}
