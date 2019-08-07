<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\verifyUser;
use App\Mail\verifyMail;
use Illuminate\Support\Facades\Input;

class RegistrationController extends Controller
{
    public function create()
    {     
        return view('registration.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (User::where('email', '=', Input::get('email'))->exists()) 
        {
            return redirect('/login')->with('warning', "Sorry this user is already registered.");
        }
        else
        {
            $user = User::create(request(['name', 'email', 'password']));
            
            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            \Mail::to($user->email)->send(new VerifyMail($user));


            // auth()->login($user);
                            
            $status = "We have send you a mail.. please check and verify that...!";
            return redirect('/login')->with('status', $status);
        }       
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
           
            if(!$user->verified)
            {
            $verifyUser->user->verified = 1;
            $verifyUser->user->save();
            $status = "Your e-mail is verified. You can now login.";
            } 
            else
            {
                $status = "Your e-mail is already verified. You can now login.";
            }
        }
        else
        {
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
        return redirect('/login')->with('status', $status);
    }


    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }

}
