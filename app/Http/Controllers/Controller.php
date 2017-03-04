<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use VisitLog;
use App\User;
use App\Message;
use View;
use DB;
use Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        VisitLog::save();

        //for messages and notidications
	    if(Auth::check()) {
	    	$usersMandN = User::all();
	    	$messagesMandN = Message::orderBy('id', 'desc')
                                ->where('to_id', '=', Auth::user()->id)
                                ->where('isDeleted', '!=', '0')
                                ->get()->unique('from_id')->take(4);
                    
	    } else {
	    	$usersMandN = collect(new User);
            $messagesMandN = collect(new Message);
	    }

        // share with all view
	    View::share('usersMandN', $usersMandN);
	   	View::share('messagesMandN', $messagesMandN);	     
    }
}


