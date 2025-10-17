<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
     public function index()
    {
        $page = Page::where('id',1)->first();
        return view('admin.page.index', compact('page'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'terms_content' => 'required',
            'privacy_content' => ['required'],
        ]);

        $page = Page::firstOrCreate(['id' => 1]);
        $page->terms_content = $request->terms_content;
        $page->privacy_content = $request->privacy_content;
        $page->save();

        return redirect()->back()->with('success', 'Page data updated successfully');
    }

}
