<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Str;


class AuthenticateCOntroller extends Controller
{
   public function create()  {
        return Inertia::render('Auth/Login',[
            'status'=>session('status')
        ]);
    }

   public function store(Request $request)  {
           $credentials=$request->validate([
            'email'=>'required',
            'password'=>'required'
           ]);

           if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
           }
         //  event(new Registered($user));

           return back()->withErrors([
'email'=>'invalid credentials'
           ])->onlyInput('email');
    }

    function destroy(Request $request)  {
        Auth::logout();
        return redirect('login');
    }

   public function notice()  {
    return Inertia::render('Auth/VerifyEmail',[
        'status'=>session('status')
    ]);

    }

   public function verify(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    }
   public function send(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Verification link sent!');
    }
    public  function reset() {
        return Inertia::render('Auth/ResetPassword')->with([
            'status'=>session('status')
        ]);
    }
    public function email (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function sendreset(Request $request) {

        return Inertia::render('Auth/Password',[
            'email'=>$request->email,
            'token'=>$request->route('token')
        ]);
    }

    public function update(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function confirm () {
        return inertia::render('Auth/PasswordConfirm');
    }

    public function confirmPassword(Request $request) {
        if (! Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => ['The provided password does not match our records.']
            ]);
        }

        $request->session()->passwordConfirmed();

        return redirect()->intended();
    }

}
