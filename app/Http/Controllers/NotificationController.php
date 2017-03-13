<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Validator, Input, Redirect, Session;
use App\Notification;
use Auth;
use DateTime;
use Illuminate\Support\Facades\Route;

class NotificationController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
        parent::__construct();
    } 


    public function index()
    {
        $adminnotifications = Notification::orderBy('id', 'desc')
                                ->where('getter_id', '=', 0)
                                ->paginate(10);
        
        $routename = Route::getFacadeRoot()->current()->uri();

        return view('notifications.admin.index')
                    ->withAdminnotifications($adminnotifications)
                    ->withRoutename($routename);
    }

    
    public function store(Request $request)
    {
        //validation
        $this->validate($request, array(
            'post_title'       => 'required|max:191',
            'slug'             => 'required|max:191',
       ));


       //store to DB
       $notification = new Notification;

       $notification->type = 'news';
       $notification->setter_id = Auth::user()->id;
       $notification->getter_id = 0;
       $notification->post_title = $request->post_title;
       $notification->slug = $request->slug;

       $notification->save();

       Session::flash('success', 'সফলভাবে বিজ্ঞপ্তি প্রকাশ করা হয়েছে');

       //redirect
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
        $adminnotifications = Notification::orderBy('id', 'desc')
                                ->where('getter_id', '=', 0)
                                ->paginate(5);
        $editadminnotification = Notification::find($id);
        
        $routename = Route::getFacadeRoot()->current()->uri();

        return view('notifications.admin.index')
                    ->withAdminnotifications($adminnotifications)
                    ->withEditadminnotification($editadminnotification)
                    ->withRoutename($routename);
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
        //validation
        $this->validate($request, array(
            'post_title'       => 'required|max:191',
            'slug'             => 'required|max:191',
       ));


       //store to DB
       $updateadminnotification = Notification::find($id);


       $updateadminnotification->post_title = $request->post_title;
       $updateadminnotification->slug = $request->slug;

       $updateadminnotification->save();

       Session::flash('success', 'সফলভাবে বিজ্ঞপ্তি সম্পাদন করা হয়েছে');

       //redirect
       return Redirect::route('adminnotifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteadminnotification = Notification::find($id);

        $deleteadminnotification->delete();

        Session::flash('success', 'বিজ্ঞপ্তিটি সফলভাবে মুছে ফেলা হয়েছ।');

       //redirect
       return Redirect::route('adminnotifications.index');
    }
}
