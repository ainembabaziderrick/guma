<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Reminder;
use App\User;
use Mail;

class ForgotPasswordController extends Controller
{
    public function forgot(){
        return view('auth.forgot');
    }

    public function password(Request $request){
           $user = User::whereEmail($request->email)->first();
           if($user==null){
            return redirect()->back()->with(['error'=>'Email does not exist']);
           }
           $user = Sentinel::findById($user->id);
           $reminder = Reminder::exists($user) ? : Reminder::create($user);
           $this->sendEmail($user,$reminder->code);

           return redirect()->back()->with(['success' => 'Reset code sent to your Email']);
    }

    public function sendEmail($user, $code){
        Mail::send(
            'email.forgot',
            ['user' => $user, 'code' => $code],
            function ($message) use ($user){
                $message->to($user->email);
                $message->subject("$user->name","Reset your Password.");
            }
        );
    }

    public function reset($email, $code){
        $user = User::whereEmail($email)->first();
        if($user==null){
         echo 'Email does not exist' ;
        }
        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user) ? : Reminder::create($user);

        if($reminder){
             if($code == $reminder->code){
                return view('auth.reset_password_form')->with(['user'=>$user, 'code'=>$code]);
             }else{
                return redirect('/');
             }
        }else{
            echo 'time expired';
        }
    }
    public function resetPassword(Request $request, $email, $code){
        $this->validate($request, [
            'password' => 'required|min:7|max:12|confirmed',
            'password_confirm' =>'required|min:7|max:12'
        ]);
        $user = User::whereEmail($email)->first();
        if($user==null){
            echo 'Email does not exist' ;
           }
        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user);

        if($reminder){
            if($code == $reminder->code){
               Reminder::complete($user, $code, $request->password);
               return redirect('/login')->with('success', 'Password reset. Please login with new password.');
            }else{
               return redirect('/');
            }
       }else{
           echo 'time expired';
       }

    }
}
