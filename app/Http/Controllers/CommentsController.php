<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator, Input, Redirect, Session;
use App\Comment;
use App\Post;
use App\Notification;
use Auth;
use DateTime;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin', ['only' => 'getReportedComments', 'delete', 'destroy', 'getReportedComments']);
        parent::__construct();
    }
    
    
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
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

        // count commentsandrepliestcount
        $post->commentsandrepliestcount = $post->commentsandrepliestcount + 1;
        $now = new DateTime();
        $post->commentsandrepliestcount_time = $now;
        $post->save();
        // count commentsandrepliestcount

        // notification data
        $notification = new Notification;
        $notification->type = 'comment';
        $notification->setter_id = Auth::user()->id;
        $notification->getter_id = $post->postedBy;
        $notification->post_title = $post->title;
        $notification->slug = $post->slug;
        $notification->save();
        // notification data

        Session::flash('success', 'মন্তব্য সফলভাবে যুক্ত হয়েছ।');

        //redirect
        return redirect()->route('blog.single', [$post->slug]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     **/
/*    public function edit($id)
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
    }*/
    
    // delete er somoy middleware a admin diye only ei method duita kore nite hobe
    public function delete($id)
    {
        $comment = Comment::find($id);
        return view('comments.delete')->withComment($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        $comment->delete();

        Session::flash('success', 'কমেন্ট সফলভাবে মুছে ফেলা হয়েছ।');

        //redirect
        return redirect()->route('posts.reportedComments');
    }


    public function report($id)
    {
        $comment = Comment::find($id);
        return view('comments.report')->withComment($comment);
    }

    public function reportconfirm($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;

        $comment->isReported = $comment->isReported + 1;
        $comment->save();

        Session::flash('success', 'কমেন্ট সফলভাবে রিপোর্ট করা হয়েছ।');

        //redirect
        return redirect()->route('posts.show', $post_id);
    }

    public function getReportedComments()
    {
        $reportedcomments = Comment::orderBy('id', 'desc')
                                   ->where('isReported', '>', '0')
                                   ->get();
        $totalreportedcomments = Comment::where('isReported', '>', '0')->get()->count();
        return view('comments.reported')
                ->withTotalreportedcomments($totalreportedcomments)
                ->withReportedcomments($reportedcomments);
    }


}
