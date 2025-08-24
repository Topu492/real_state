<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
     return view('front.home');
   }

    public function contact()
    {
        return view('front.contact');
    }

    public function select_user()
    {
        return view('front.select_user');
    }
    public function pricing()
    {
        $packages = Package::orderBy('id','asc')->get();
        return view('front.pricing', compact('packages'));
    }
}
