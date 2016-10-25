<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator, Input, Redirect, Session;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Mail;


class PagesController extends Controller {
  
	public function getIndex() {
		$posts = Post::orderBy('created_at', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->paginate(5); // it will be 15
        $populars = Post::orderBy('hits', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->take(10)
                                ->get();

        
                       
        return view('pages.welcome')
        			->withPosts($posts)
                    ->withPopulars($populars);
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
            'subject'     => 'required|min:5' ,
            'message'     => 'required|min:5'       
       ));

       $data = ['email'   => $request->email,
                'subject'   => $request->subject,
                'bodyMessage'   => $request->message];

       Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->from($data['email']);
            $message->sender('blog@HoTg.org', 'John Doe');
        
            $message->to('blog@HoTg.org');
        
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
        $tag = Tag::where('name', '=', $name)->first();
        $taglist = Tag::all();

        return view('pages.categories_tags')
        		->withTag($tag)
        		->withTaglist($taglist);
    }    

    public function getCategoryCategories($name) {
        $category = Category::where('name', '=', $name)->first();
        $categorylist = Category::all();

        return view('pages.categories_categories')
        		->withCategory($category)
        		->withCategorylist($categorylist);
    }

    public function getAuthor($author) {
        $user = User::where('name', '=', $author)->first();
        $posts = Post::orderBy('created_at', 'desc')
                                ->where('postedBy', '=', $author)
                                ->where('isDeleted', '!=', '0')
                                ->get(); // it will be 15
                       
        return view('pages.author')
            ->withUser($user)
            ->withPosts($posts);
    }

}
