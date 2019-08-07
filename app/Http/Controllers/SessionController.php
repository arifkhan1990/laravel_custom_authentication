<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Auth;

class SessionController extends Controller
{
    public function create()
    {
        if(Auth::check())
        {
            return view('welcome');
        }
        else
        {
            return view('sessions.create');
        }
       
    }
    
    public function store()
    {

        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }
        
        if (! auth()->user()->verified) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
       
        return redirect()->to('/');
    }


    public function destroy()
    {
        auth()->logout();
        
        return redirect()->to('/login');
    }
}