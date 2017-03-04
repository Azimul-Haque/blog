<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\Comment;
use App\Category;
use App\Tag;
use App\User;
use App\Message;
use Validator, Input, Redirect, Session;
use Auth;
use Purifier;
use Image;
use Mail;
use DB;

class UserController extends Controller
{
	public function __construct() {
        $this->middleware('auth', ['except' => ['getBloodbank',]]);
        parent::__construct();
    }

    public function changePassword(Request $request, $id) {
        //validation
        $this->validate($request, array(
            'password' 				=> 'required|min:6|confirmed',
            'password_confirmation' => 'required',
       ));


        // update to DB
        $user = User::find($id);

        $user->password = bcrypt($request->password);

        $user->save();

        Session::flash('success', 'সফলভাবে পাসওয়ার্ড পরিবর্তন করা হয়েছে');
         
        //redirect
        return redirect()->route('posts.profile');
    }

    public function updateProfile(Request $request, $id) {

        $updateUser = User::find($id);

        //validation
        if($request->name == $updateUser->name) {
            $this->validate($request, array(
                'phone'     => 'required|max:255',
                'fb'        => 'sometimes|max:255',
                'blood_group'       => 'required|max:255',
                'last_donated'       => 'sometimes|max:255',
                'permanent_district'       => 'required|max:255',
                'permanent_upazila'       => 'sometimes|max:255',
                'permanent_address_privacy' => 'sometimes|max:255',
                'present_district'       => 'required|max:255',
                'present_upazila'       => 'sometimes|max:255',
                'present_address_privacy'       => 'required|max:255',
                'image'        => 'sometimes|image|max:400',
                'about'     => 'required|min:100',
            ));
        } else {
            $this->validate($request, array(
                'name'      => 'required|max:255|unique:users,name',
                'phone'     => 'required|max:255',
                'fb'        => 'sometimes|max:255',
                'blood_group'       => 'required|max:255',
                'last_donated'       => 'sometimes|max:255',
                'permanent_district'       => 'required|max:255',
                'permanent_upazila'       => 'sometimes|max:255',
                'permanent_address_privacy' => 'sometimes|max:255',
                'present_district'       => 'required|max:255',
                'present_upazila'       => 'sometimes|max:255',
                'present_address_privacy'       => 'required|max:255',
                'image'        => 'sometimes|image|max:400',
                'about'     => 'required|min:100',
            ));
        }
    	


        $updateUser->name = $request->name;
        $updateUser->phone = $request->phone;
        $updateUser->fb = $request->fb;
        $updateUser->blood_group = $request->blood_group;
        $updateUser->last_donated = $request->last_donated;

        $updateUser->permanent_district = $request->permanent_district;
        if($request->permanent_district != 'ঠাকুরগাঁও') {
            $request->permanent_upazila = '';
        }
        $updateUser->permanent_upazila = $request->permanent_upazila;
        $updateUser->permanent_address_privacy = $request->permanent_address_privacy;

        $updateUser->present_district = $request->present_district;
        if($request->present_district != 'ঠাকুরগাঁও') {
            $request->present_upazila = '';
        }
        $updateUser->present_upazila = $request->present_upazila;
        $updateUser->present_address_privacy = $request->present_address_privacy;
        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = $updateUser->email. '.' . $image->getClientOriginalExtension();
            $location   = public_path('images/profilepicture/'. $filename);

            Image::make($image)->resize(300, 300)->save($location);
            /*Image::make($image)->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
            })->save($location);*/

            $updateUser->image = $filename;

        }
        $updateUser->about = $request->about;

        $updateUser->save(); 

        Session::flash('success', 'সফলভাবে হালনাগাদ করা হয়েছে');
                                  
        //redirect
        return redirect()->route('posts.profile');
    }

    public function sendMessage(Request $request) {
        //validation
        $this->validate($request, array(
            'to_id'      => 'required',
            'to_name'    => 'required',
            'to_email'    => 'required',
            'from_id'    => 'required',
            'from_name'    => 'required',
            'from_email'    => 'required',
            'message'    => 'required',
        ));

        //store to DB
        $message = new Message;

        $message->to_id = $request->to_id;
        $message->from_id = $request->from_id;
        $message->message = $request->message;

        $message->save();

        // send a email to the receipient
        $data = ['to_email'   => $request->to_email,
                'from_email'   => $request->from_email,
                'subject'   => 'চিরকুট | ব্লগ | হিউম্যানস অব ঠাকুরগাঁও',
                'sender'   => $request->from_name,
                'bodyMessage'   => $request->message];

        Mail::send('emails.message', $data, function ($message) use ($data) {
            $message->from($data['from_email']);
            $message->sender('blog@humansofthakurgaon.org', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও');
        
            $message->to($data['to_email']);
            $message->cc('blog@humansofthakurgaon.org');
            //$message->bcc('john@johndoe.com', 'John Doe');
        
            $message->replyTo($data['from_email']);
            $message->subject($data['subject']);        
            $message->priority(3);
        
            //$message->attach('pathToFile');
        });
        // send a email to the receipient

        Session::flash('success', 'চিরকুট সফলভাবে পাঠানো হয়েছে।');
                                  
        //redirect
        return Redirect::back();        
    }

    public function readMessage() {
        $messages = Message::select(DB::raw('*, max(created_at) as created_at'))
                                ->orderBy('created_at', 'desc')
                                ->groupBy('from_id')
                                ->where('to_id', '=', Auth::user()->id)
                                ->where('isDeleted', '!=', '0')
                                ->paginate(4);
        $users = User::orderBy('id', 'desc')->get();                            

        return view('messages.index')
                    ->withMessages($messages)
                    ->withUsers($users);
    }

    // conversation methods
    public function sendConversationMessage (Request $request) {
        //validation
        $this->validate($request, array(
            'to_id'      => 'required',
            'to_name'    => 'required',
            'to_email'    => 'required',
            'from_id'    => 'required',
            'from_name'    => 'required',
            'from_email'    => 'required',
            'message'    => 'required',
        ));

        //store to DB
        $message = new Message;

        $message->to_id = $request->to_id;
        $message->from_id = $request->from_id;
        $message->message = $request->message;

        $message->save();

        // send a email to the receipient
        /*EITA PORE DEKHA JABE>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<*/
        // send a email to the receipient

        //Session::flash('success', 'চিরকুট সফলভাবে পাঠানো হয়েছে।');
                                  
        //redirect
        return redirect()->route('conversation.read', $request->to_name);
    }

    public function getConversation ($name) {
        $users = User::orderBy('id', 'desc')->get();
        $otherone = User::where('name', '=', $name)->first();
        $otheroneposts = Post::where('postedBy', '=', $otherone->id)->get();
        $messages = Message::orderBy('id', 'asc')
                                ->where([
                                    ['to_id', '=', Auth::user()->id],
                                    ['from_id', '=', $otherone->id],
                                    ])
                                ->orWhere([
                                    ['from_id', '=', Auth::user()->id],
                                    ['to_id', '=', $otherone->id],
                                    ])
                                ->where('isDeleted', '!=', '0')
                                ->get();
                                   

        return view('messages.conversation')
                    ->withMessages($messages)
                    ->withUsers($users)
                    ->withOtheroneposts($otheroneposts)
                    ->withOtherone($otherone);
    }

    // reply message method
    // reply message method

    // blood bank
    public function getBloodbank () {
        $donors = User::orderBy('id', 'desc')->get();

        return view('bloodbank.index')
                    ->withDonors($donors);   
    }
    // blood bank
}
