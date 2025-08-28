<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Agent;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
     public function dashboard()
    {
       

        return view('agent.dashboard.index');
    }

    public function registration()
    {
        return view('agent.auth.registration');
    }

    public function registration_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'company' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $token = hash('sha256', time());

        $agent = new Agent();
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->company = $request->company;
        $agent->designation = $request->designation;
        $agent->password = Hash::make($request->password);
        $agent->token = $token;
        $agent->save();

        $link = url('agent/registration-verify/'.$token.'/'.$request->email);
        $subject = 'Registration Verification';
        $message = 'Click on the following link to verify your email: <br><a href="' . $link . '">' . $link . '</a>';

        \Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with('success', 'Registration successful. Please check your email to verify your account.');
    }

    public function registration_verify($token, $email)
    {
        $agent = Agent::where('email', $email)->where('token', $token)->first();
        if (!$agent) {
            return redirect()->route('agent_login')->with('error', 'Invalid token or email');
        }
        $agent->token = '';
        $agent->status = 1;
        $agent->update();

        return redirect()->route('agent_login')->with('success', 'Email verified successfully. You can now login.');
    }

    public function login()
    {
        return view('agent.auth.login');
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
            'status' => 1,
        ];

        if(Auth::guard('agent')->attempt($data)){
            return redirect()->route('agent_dashboard')->with('success', 'Logged in successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('agent')->logout();
        return redirect()->route('agent_login')->with('success', 'Logged out successfully');
    }

    public function forget_password()
    {
        return view('agent.auth.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $agent = Agent::where('email', $request->email)->first();
        if(!$agent){
            return redirect()->back()->with('error', 'Email not found');
        }

        $token = hash('sha256', time());
        $agent->token = $token;
        $agent->update();

        $link = route('agent_reset_password', [$token,$request->email]);
        $subject = 'Reset Password';
        $message = 'Click on the following link to reset your password: <br>';
        $message .= '<a href="'.$link.'">'.$link.'</a>';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Reset password link sent to your email');

    }

    public function reset_password($token, $email)
    {
        $agent = Agent::where('email', $email)->where('token', $token)->first();
        if(!$agent){
            return redirect()->route('agent_login')->with('error', 'Invalid token or email');
        }
        return view('agent.auth.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $agent = Agent::where('email', $email)->where('token', $token)->first();
        $agent->password = Hash::make($request->password);
        $agent->token = '';
        $agent->update();

        return redirect()->route('agent_login')->with('success', 'Password reset successfully');
    }

    public function profile()
    {
        return view('agent.profile.index');
    }

    public function profile_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:agents,email,'.Auth::guard('agent')->user()->id,
            'company' => 'required',
            'designation' => 'required', 
        ]);

        $agent = Agent::where('id',Auth::guard('agent')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'agent_'.time().'.'.$request->photo->extension();
            if($agent->photo != '') {
                unlink(public_path('uploads/'.$agent->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $agent->photo = $final_name;
        }

        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $agent->password = Hash::make($request->password);
        }
        
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->company = $request->company;
        $agent->designation = $request->designation;
        $agent->phone = $request->phone;
        $agent->address = $request->address;
        $agent->country = $request->country;
        $agent->state = $request->state;
        $agent->city = $request->city;
        $agent->zip = $request->zip;
        $agent->facebook = $request->facebook;
        $agent->twitter = $request->twitter;
        $agent->linkedin = $request->linkedin;
        $agent->instagram = $request->instagram;
        $agent->website = $request->website;
        $agent->biography = $request->biography;
        $agent->update();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

     public function payment()
    {
        $total_current_order = Order::where('agent_id', Auth::guard('agent')->user()->id)->count();
        $packages = Package::orderBy('id','asc')->get();
        $current_order = Order::where('agent_id', Auth::guard('agent')->user()->id)->where('currently_active',1)->first();

        // How many days left for the current order
         if($current_order){
            $days_left = (strtotime($current_order->expire_date) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
        } else {
            $days_left = 0;
        }

        return view('agent.payment.index', compact('packages','total_current_order', 'current_order', 'days_left'));
    }

}


