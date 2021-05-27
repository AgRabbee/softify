<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Role;
use App\Models\Company;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function getSignin()
    {
        return view('auth/signin');
    }

    public function Signin(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'],'user_status'=>0])) {
            session()->flash('type','danger');
            session()->flash('message','User registration is not accepted yet. Contact with System admin');
            return redirect()->back();
        }elseif (Auth::attempt(['email' => $request['email'], 'password' => $request['password'],'user_status'=>1])) {
            if (Auth::user()->user_type == 1) {
                return redirect('/dashboard');
            }else {
                return redirect()->intended('/');
            }
        }
        session()->flash('type','danger');
        session()->flash('message','Invalid email or password');
        return redirect()->back();
    }


    public function getSignup()
    {
        return view('auth/signup');
    }

    public function Signup(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();
        session()->flash('type','success');
        session()->flash('message','Sign up Complete Successfully.');
        return redirect('/signin');
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('provider_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt('123456'),
                    'provider_name'=> 'google',
                    'provider_id'=> $user->id,
                ]);
                Auth::login($newUser);
            }

            return redirect()->intended('/');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->stateless()->user();
            $finduser = User::where('provider_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt('123456'),
                    'provider_name'=> 'facebook',
                    'provider_id'=> $user->id,
                ]);
                Auth::login($newUser);
            }
            return redirect()->intended('/');

        } catch (Exception $e) {
            return redirect('redirect');
        }
    }
}
