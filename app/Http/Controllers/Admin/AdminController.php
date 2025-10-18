<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Package;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {

        $total_packages = Package::count();
        $total_active_subscribers = Subscriber::where('status', 1)->count();
        $total_active_customers = User::where('status', 1)->count();
        $total_active_agents = Agent::where('status', 1)->count();
        return view('admin.dashboard.index', compact('total_packages','total_active_subscribers', 'total_active_customers', 'total_active_agents'));
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];

        if(Auth::guard('admin')->attempt($data)){
            return redirect()->route('admin_dashboard')->with('success', 'Logged in successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'Logged out successfully');
    }

     public function forget_password()
    {
        return view('admin.auth.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if(!$admin){
            return redirect()->back()->with('error', 'Email not found');
        }

        $token = hash('sha256', time());
        $admin->token = $token;
        $admin->update();

        $link = route('admin_reset_password', [$token,$request->email]);
        $subject = 'Reset Password';
        $message = 'Click on the following link to reset your password: <br>';
        $message .= '<a href="'.$link.'">'.$link.'</a>';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Reset password link sent to your email');

    }


    public function reset_password($token, $email)
    {
        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if(!$admin){
            return redirect()->route('admin_login')->with('error', 'Invalid token or email');
        }
        return view('admin.auth.reset_password', compact('token', 'email'));
    }


     public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $admin = Admin::where('email', $email)->where('token', $token)->first();
        $admin->password = Hash::make($request->password);
        $admin->token = '';
        $admin->update();

        return redirect()->route('admin_login')->with('success', 'Password reset successfully');
    }

    
    public function profile()
    {
        return view('admin.profile.index');
    }

    public function profile_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.Auth::guard('admin')->user()->id,
        ]);

        $admin = Admin::where('id',Auth::guard('admin')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'admin_'.time().'.'.$request->photo->extension();
            if($admin->photo != '') {
                unlink(public_path('uploads/'.$admin->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $admin->photo = $final_name;
        }

        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $admin->password = Hash::make($request->password);
        }
        
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->update();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

}
