<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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
}
