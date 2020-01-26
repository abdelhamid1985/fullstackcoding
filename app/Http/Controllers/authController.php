<?php

namespace App\Http\Controllers;

use App\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class authController extends Controller
{
    
    public function login(){
        return view("auth.login");
    }
    
    public function authenticate(Request $request) {
        //die(Hash::make("abcd123"));
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('/');
        }else{
            $errors = array("error" => "Username or password is incorrect");
            return redirect("login")->with($errors);
        }
   }
   
   public function logout() {
       Auth::logout();
       return redirect("login");
   }
   
   public function signup(Request $request){
       $username = $request->get('username');
       $email = $request->get('email');
       $password = Hash::make($request->get('password'));
       
       $user = new User;
       $user->username = $username;
       $user->email = $email;
       $user->password = $password;
       $user->save();
       
       return redirect("login");
   }
    
    
}
