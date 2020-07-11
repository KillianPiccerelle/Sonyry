<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Return the creation page view
     */
    public function create(){
        return view('page.create');
    }

    /**
     * @param Request $request
     * Store the page in the database
     */
    public function store(Request $request){
        $page = new Page();

        $page->title = $request->input('title');
        $page->description = $request->input('description');
        $page->user_id = Auth::user()->id;

        $page->save();

    }
}
