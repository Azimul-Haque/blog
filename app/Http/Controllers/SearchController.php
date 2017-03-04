<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\User;
use Validator, Input, Redirect, Session;
use Auth;

class SearchController extends Controller
{
    public function __construct(){
        parent::__construct();
    }
    public function getResult(Request $request) {
    	//validation
        $this->validate($request, array(
            'search'  => 'required|max:255',
        ));

        $request = $request->search;

    	$searchresults = Post::orderBy('created_at', 'desc')
                                ->where(function ($query) use ($request) {
                                    $query->where('title', 'LIKE', '%' . $request . '%')
                                          ->orWhere('body', 'LIKE', '%' . $request . '%');
                                })
                                ->where('isDeleted', '!=', '0')
                                ->where('isPublished', '=', 'publish')
    						    ->paginate(10);
    	$users = User::orderBy('id', 'desc')->get();    					    

    	return view('pages.searchresults')
                    ->withRequest($request)
                    ->withSearchresults($searchresults)
                    ->withUsers($users);
    }
}
