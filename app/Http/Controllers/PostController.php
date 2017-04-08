<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Validator, Input, Redirect, Session;
use Auth;
use Purifier;
use Image;


class PostController extends Controller {
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['getBloggersList', 'getAllblogposts', 'makeFeatured']]);
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')
                                ->where('postedBy', '=', Auth::user()->id) // email id dite hobe
                                ->where('isDeleted', '!=', '0')
                                ->where('isPublished', '=', 'publish') 
                                ->paginate(5);
        $categories = Category::all();     

        return view('posts.index')
                    ->withPosts($posts);

        //$posts = DB::table('posts')
                          //  ->where('isDeleted', '!=', '0')
                          // ->orderBy('id', 'desc')
                          //  ->paginate(5);
        //return view('posts.index', ['posts' => $posts]);
    }

    public function getDrafts()
    {
        $posts = Post::orderBy('id', 'desc')
                                ->where('postedBy', '=', Auth::user()->id) // email id dite hobe
                                ->where('isDeleted', '!=', '0')
                                ->where('isPublished', '=', 'draft') 
                                ->paginate(5);
        $categories = Category::all();     

        return view('posts.drafts')
                    ->withPosts($posts);

        //$posts = DB::table('posts')
                          //  ->where('isDeleted', '!=', '0')
                          // ->orderBy('id', 'desc')
                          //  ->paginate(5);
        //return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')
                    ->withCategories($categories)
                    ->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */   
    public function store(Request $request)
    {
        //validation
        $this->validate($request, array(
            'title'       => 'required|max:255',
            'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'        => 'required',
            'featured_image'        => 'sometimes|image|max:300',
            'isPublished'        => 'required'
       ));


        //store to DB
        $post = new Post;

        $post->title = $request->title;
        $post->postedBy = Auth::user()->id;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body, 'youtube');

        // image upload
        if($request->hasFile('featured_image')) {
            $image      = $request->file('featured_image');
            $filename   = time(). '.' . $image->getClientOriginalExtension(); 
            $location   = public_path('images/' . $filename);

            Image::make($image)->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            })->save($location);

            $post->image = $filename;

        }
        $post->isPublished = $request->isPublished;

        $post->save();

        $post->tags()->sync($request->tags, false);

        if($request->isPublished == 'publish') {
            Session::flash('success', 'সফলভাবে প্রকাশ করা হয়েছে');
        } elseif($request->isPublished == 'draft') {
            Session::flash('success', 'সফলভাবে সংরক্ষণ করা হয়েছে'); 
        }

        //redirect
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', '=' , $id)
                            ->where('isDeleted', '!=', '0')
                            ->where('postedBy', '=', Auth::user()->id)
                            ->first();
        $categories = Category::all();                    
        return view('posts.show')
                    ->withPost($post);
        //$post = DB::table('posts')
          //                  ->where('id', '=' , $id)
          //                  ->where('isDeleted', '!=', '0')
          //                  ->first();
        //return view('posts.show', ['post' => $post]);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == 'admin') {
            $post = Post::find($id);
        } else {
            $post = Post::where('id', '=' , $id)
                                ->where('isDeleted', '!=', '0')
                                ->where('postedBy', '=', Auth::user()->id)
                                ->first();
        }
        $categories = Category::all();
        $tags = Tag::all();  

        $cats = [];
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;  
        }
        
        $tags2 = [];
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;  
        }

        return view('posts.edit')->withPost($post)
                        ->withCategories($cats)
                        ->withTags($tags2);

        //$post = DB::table('posts')
                 //           ->where('id', '=' , $id)
                 //           ->where('isDeleted', '!=', '0')
                 //           ->first();
       // return view('posts.edit', ['post' => $post]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
       if(Auth::user()->role == 'admin') {
            $post = Post::find($id);
        } else {
            $post = Post::where('id', '=' , $id)
                                ->where('isDeleted', '!=', '0')
                                ->where('postedBy', '=', Auth::user()->id)
                                ->first();
        }

       if($request->input('slug') == $post->slug){
            $this->validate($request, array(
                'title'=>'required | max:255',
                'category_id'=>'required | integer',
                'body'=>'required'
            ));
       } else{
            $this->validate($request, array(
                'title'=>'required | max:255',
                'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'=>'required | integer',
                'body'=>'required'
            ));
       }
       

       $post->title = $request->input('title');
       $post->slug = $request->input('slug');
       $post->category_id = $request->input('category_id');
       $post->body = Purifier::clean($request->input('body'), 'youtube');
       $post->isPublished = $request->isPublished;

       $post->save();
       
       if(isset($request->tags)){
            $post->tags()->sync($request->tags, true);
       }else{

       }
       
       Session::flash('success', 'সফলভাবে হালনাগাদ করা হয়েছে');

       //redirect
       return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(Auth::user()->role == 'admin') {
            $post = Post::find($id);
        } else {
            $post = Post::where('id', '=' , $id)
                                ->where('isDeleted', '!=', '0')
                                ->where('postedBy', '=', Auth::user()->id)
                                ->first();
        }

       $post->category_id = '';
       $post->isDeleted = '0';

       $post->save();
       $post->tags()->detach();

        Session::flash('success', 'সফলভাবে মূছে ফেল হয়েছে');

        //redirect
        return redirect()->route('posts.index');
    }

    public function getProfile() {
        $blogger = User::where('id', '=', Auth::user()->id )->first();
        $posts = Post::orderBy('created_at', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->get();


        return view('posts.profile')
                        ->withBlogger($blogger)
                        ->withPosts($posts);
    }

    public function getBloggersList() {
        $users = User::orderBy('id', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->get(); // it will be 15

        return view('posts.bloggerlist')
                    ->withUsers($users)
                    ->withPosts($posts);
    }

    public function getAllblogposts() {
        $users = User::orderBy('id', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->where('isPublished', '=', 'publish')
                                ->get();

        return view('pages.allposts')
                    ->withUsers($users)
                    ->withPosts($posts);
    }

    public function makeFeatured(Request $request, $id) {
        
        // first, make the previous featured post unfeatured
        $previousFeature = Post::where('featured', '=', 'YES')->first();
        if($previousFeature) {
            $previousFeature->featured = '1';
            $previousFeature->save();
        }

        // now, make the selected one featured
        $newFeatured = Post::find($id);

        $newFeatured->featured = 'YES';
        $newFeatured->save();

        Session::flash('success', 'সফলভাবে ফিচারড করা হয়েছে');
                                  
        //redirect
        return redirect()->route('posts.allblogposts');
    }



    
}
