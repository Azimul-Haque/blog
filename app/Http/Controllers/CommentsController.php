<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator, Input, Redirect, Session;
use App\Comment;
use App\Post;
use Auth;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => 'store']);
    }
    /**
     * Display a listing of the resource.
     * DELETED INDEX, CREATE AND SHOW AS THEY ARE NOT NECESSARY
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'comment'=>'required|min:5|max:2000'
        ));

        $comment = new Comment();
        $post = Post::find($post_id);

        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);

        $comment->save();

        Session::flash('success', 'মন্তব্য সফল্ভাবে যুক্ত হয়েছ।');

        //redirect
        return redirect()->route('blog.single', [$post->slug]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**   public function edit($id)
    {
        $comment = Comment::where('id', '=', $id)
                            ->where($comment->post->postedBy, '=', Auth::user()->name)
                            ->where($comment->post->isDeleted, '!=', '0')
                            ->first();

        return view('comments.edit')->withComment($comment);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $this->validate($request, ['comment'=>'required']);

        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success', 'কমেন্ট সফল্ভাবে হালনাগাদ করা হয়েছ।');

        //redirect
        return redirect()->route('posts.show', [$comment->post->id]);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        return view('comments.delete')->withComment($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;

        $comment->delete();

        Session::flash('success', 'কমেন্ট সফলভাবে মুছে ফেলা হয়েছ।');

        //redirect
        return redirect()->route('posts.show', $post_id);
    }
*/

    public function report($id)
    {
        $comment = Comment::find($id);
        return view('comments.report')->withComment($comment);
    }

    public function reportconfirm($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;

        $comment->isReported = 1;
        $comment->save();

        Session::flash('success', 'কমেন্ট সফলভাবে রিপোর্ট করা হয়েছ।');

        //redirect
        return redirect()->route('posts.show', $post_id);
    }
}
