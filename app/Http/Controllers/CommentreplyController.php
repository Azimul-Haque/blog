<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator, Input, Redirect, Session;
use App\Commentreply;
use App\Comment;
use App\Post;
use App\Notification;
use Auth;
use DateTime;

class CommentreplyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        parent::__construct();
    }
    

    public function store(Request $request, $comment_id)
    {
        $this->validate($request, array(
            'email'=>'required|email|max:191',
            'commentreply'=>'required|max:2000'
        ));

        $commentreply = new Commentreply();
        $comment = Comment::find($comment_id);

        $commentreply->email = $request->email;
        $commentreply->commentreply = $request->commentreply;
        $commentreply->comment()->associate($comment);

        $commentreply->save();

        // count commentsandrepliestcount
        $post = Post::where('id','=',$comment->post_id)
                        ->where('isDeleted', '!=', '0')
                        ->where('isPublished', '=', 'publish')
                        ->first();

        $post->commentsandrepliestcount = $post->commentsandrepliestcount + 1;
        $now = new DateTime();
        $post->commentsandrepliestcount_time = $now;
        $post->save();
        // count commentsandrepliestcount

        // notification data
        $notification = new Notification;
        $notification->type = 'reply';
        $notification->setter_id = Auth::user()->id;
        $notification->getter_id = $post->postedBy;
        $notification->post_title = $post->title;
        $notification->slug = $post->slug;
        $notification->save();
        // notification data

        Session::flash('success', 'প্রতিমন্তব্য সফলভাবে যুক্ত হয়েছ।');

        //redirect back to the specific article
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
