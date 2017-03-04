<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator, Input, Redirect, Session;
use App\Commentreply;
use App\Comment;
use Auth;

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
