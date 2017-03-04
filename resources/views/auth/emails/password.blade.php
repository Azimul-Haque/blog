পাসওয়ার্ড রিসেট করবার জন্য এই লিংক-এ ক্লিক করুন<br/>
          
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

