<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/posts';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
        parent::__construct();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|max:255',
            'fb' => 'sometimes|max:255',
            'blood_group' => 'required|max:255',
            'last_donated' => 'sometimes|max:255',
            'about' => 'required|min:100',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'role' => $data['role'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'fb' => $data['fb'],
            'blood_group' => $data['blood_group'],
            'last_donated' => $data['last_donated'],
            'about' => $data['about'],
            'password' => bcrypt($data['password']),
        ]);

        // send a email to the receipient
        $dataMail = ['to_email'   => $data['email'],
                'from_email'   => 'blog@humansofthakurgaon.org',
                'subject'   => 'স্বাগতম | ব্লগ | হিউম্যানস অব ঠাকুরগাঁও',
                'bodyMessage'   => 'স্বাগতম '.$data['name']. '। এই ইমেইল এড্রেসের বিপরীতে আপনি ব্লগ | হিউম্যানস অব ঠাকুরগাঁও-এ নিবন্ধন করেছেন।'];

        Mail::send('emails.welcome', $dataMail, function ($message) use ($dataMail) {
            $message->from($dataMail['from_email']);
            $message->sender('blog@humansofthakurgaon.org', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও');
        
            $message->to($dataMail['to_email']);
            $message->cc('blog@humansofthakurgaon.org');
        
            $message->replyTo($dataMail['from_email']);
            $message->subject($dataMail['subject']);        
            $message->priority(3);
        
            //$message->attach('pathToFile');
        });
        // send a email to the receipient

        return $user;
    }
}
