<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\contracts\Mail\Mailable;

class UserController extends Controller
{
    public function showlogin(){

        return view('login');
    }

    public function showregister(){
        return view('register');
    }

    public function register(Request $request){
        $email_to = $request->email;
      $confirmation_code = time().uniqid(true);
      $user=  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'confirmation_code' => $confirmation_code,
            'confirmed' => 0,
        ]);
        Mail::send('verify', compact('user', 'confirmation_code'), function($message) use($email_to) {
            $message->from('pn463187@gmail.com', 'Phong Nguyen Duc');
            $message->to( $email_to, $email_to);
            $message->subject('Verify your email address');
        });
        return redirect(route('login'))->with('status', 'Vui lòng xác nhận tài khoản email');

    }
    
    public function activate($token)
    {
        $user = User::where('confirmation_code', $token);

        if ($user->count() > 0) {   
            $user->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);
            $notification_status = 'Bạn đã xác nhận thành công';
        } else {
            $notification_status ='Mã xác nhận không chính xác';
        }

        return redirect(route('login'))->with('status', $notification_status);
    }

   
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return "Dang nhap thanh cong";
        } else {
            // Đăng nhập thất bại
            return " 'Email hoặc mật khẩu không chính xác.'";
        }
        
    }


}
