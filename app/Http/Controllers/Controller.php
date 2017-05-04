<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use VisitLog;
use App\User;
use App\Post;
use App\Comment;
use App\Commentreply;
use App\Message;
use App\Notification;
use View;
use DB;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Cache;
use Sarfraznawaz2005\VisitLog\Models\VisitLog as VisitLogModelC;




class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        
        // count visits
        VisitLog::save();

        // return visits stats
        $visitlogvisits = VisitLogModelC::orderBy('id', 'desc')->first();

        // return posts info stats
        $totalpostsforfooter = Post::orderBy('id', 'desc')->first();
        $totalcomments = Comment::orderBy('id', 'desc')->first();
        $totalcommentsreply = Commentreply::orderBy('id', 'desc')->first();
        $totalcomandrepsforfooter =  $totalcomments->id + $totalcommentsreply->id;
        $totaluserforfooter = User::orderBy('id', 'desc')->first();



        // set local lang to Bangla
        Carbon::setLocale('bn');

        //for messages and notifications
	    if(Auth::check()) {
	    	$usersMandN = User::all();
	    	$messagesMandN = Message::orderBy('id', 'desc')
                                ->where('to_id', '=', Auth::user()->id)
                                ->where('isDeleted', '!=', '0')
                                ->get()->unique('from_id')->take(4);
            $notifications = Notification::orderBy('id', 'desc')
                                         ->where('getter_id', 0) //->whereBetween('getter_id', [0, Auth::user()->id])
                                         ->orWhere('getter_id', Auth::user()->id)
                                         ->get()->take(4);
                                         
            $unread = Message::where('to_id', '=', Auth::user()->id)
                                ->where('read', '=', 1)
                                ->count();
                    
	    } else {
	    	$usersMandN = collect(new User);
            $messagesMandN = collect(new Message);
            $notifications = collect(new Notification);
            $unread = collect(new Message);
	    }

        // share with all view
	    View::share('usersMandN', $usersMandN);
        View::share('messagesMandN', $messagesMandN);
        View::share('notifications', $notifications);
        View::share('unread', $unread);
        View::share('visitlogvisits', $visitlogvisits);
        View::share('totalpostsforfooter', $totalpostsforfooter);
        View::share('totalcomandrepsforfooter', $totalcomandrepsforfooter);
	   	View::share('totaluserforfooter', $totaluserforfooter);

          
    }
}

