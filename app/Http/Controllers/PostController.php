<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;
use Validator, Input, Redirect, Session;
use Auth;
use Purifier;

class PostController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->where('postedBy', '=', Auth::user()->name)
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
            'body'        => 'required'

       ));


        //store to DB
        $post = new Post;

        $post->title = $request->title;
        $post->postedBy = Auth::user()->name;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'সফলভাবে পাবলিশ করা হয়েছে');

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
                            ->where('postedBy', '=', Auth::user()->name)
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
        $post = Post::where('id', '=' , $id)
                                ->where('isDeleted', '!=', '0')
                                ->where('postedBy', '=', Auth::user()->name)
                                ->first();
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
       
       $post = Post::find($id);

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
       $post->body = Purifier::clean($request->input('body'));

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
       $post = Post::find($id);

       $post->category_id = '';
       $post->isDeleted = '0';

       $post->save();
       $post->tags()->detach();

        Session::flash('success', 'সফলভাবে মূছে ফেল হয়েছে');

        //redirect
        return redirect()->route('posts.index');
    }

    public function getProfile() {
        return view('posts.profile');
    }
}
