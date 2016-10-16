<?php

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {
  
	public function getIndex() {
		$posts = Post::orderBy('created_at', 'desc')
                                ->where('isDeleted', '!=', '0')
                                ->paginate(5); // it will be 15
        return view('pages.welcome')->withPosts($posts);
	}  

	public function getAbout() {
		return view('pages.about');
	}  

	public function getContact() {
		return view('pages.contact');
	}

}
