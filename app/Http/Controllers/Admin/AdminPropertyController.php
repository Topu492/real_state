<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class AdminPropertyController extends Controller
{
   
    public function index()
    {
        $properties = Property::orderBy('id', 'desc')->get();
        return view('admin.property.index', compact('properties'));
    }

    
    public function detail($id)
    {
        $property = Property::where('id',$id)->first();
        return view('admin.property.detail', compact('property'));
    }
}
