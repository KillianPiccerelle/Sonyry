<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    public function __construct()
{
    $this->middleware('auth');
}

    public function index(){
        $pages = Page::where('user_id', Auth::user()->id)->get();
        return view('page.index',[
            'pages'=>$pages
        ]);
    }

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

        $image = $request->file('image');
        $imageFullName = $image->getClientOriginalName();
        $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $file = time(). '_' . $imageName . '.' . $extension;
        $image->storeAs('public/pages/'.Auth::user()->id, $file);

        $page->image = $file;

        $page->save();

        return redirect()->route('page.index');
    }

    public function edit($id){
        $page = Page::find($id);

        return view('page.edit',[
            'page'=>$page
        ]);
    }

    public function update(Request $request, $id){
        $page = Page::find($id);

        if($request->input('title') != null){
            $page->title = $request->input('title');
        }
        if($request->input('description') != null){
            $page->description = $request->input('description');
        }
        if($request->file('image')){
            //update de l'image
            //suppression de l'ancienne image
            $fileToDelete = 'public/pages/'.Auth::user()->id.'/'.$page->image;

            if(Storage::exists($fileToDelete)){
                Storage::delete($fileToDelete);
            }
            $image = $request->file('image');
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $file = time(). '_' . $imageName . '.' . $extension;
            $image->storeAs('public/pages/'.Auth::user()->id, $file);
            $page->image = $file;
        }

        $page->save();

        return redirect()->route('page.edit', $page->id);


    }

    /**
     *delete the page in the database
     */
    public function delete($id){
        $page = Page::find($id);

        $fileToDelete = 'public/pages/'.Auth::user()->id.'/'.$page->image;

        if(Storage::exists($fileToDelete)){
            Storage::delete($fileToDelete);
        }

        $page->delete();

        return redirect()->route('page.index');
    }
}