<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function create(){
        $pages = Page::where('user_id', Auth::user()->id)->get();
        return view('collection.create',[
            'pages'=>$pages
        ]);
    }

    public function store(Request $request){
        $collection = new Collection();

        $collection->name = $request->input('name');
        $collection->description = $request->input('description');
        $collection->user_id = Auth::user()->id;


        if($request->file('image')) {

            $image = $request->file('image');
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $file = time(). '_' . $imageName . '.' . $extension;
            $image->storeAs('public/collections/'.Auth::user()->id, $file);

        }
        else{
            $file = 'default_collection.jpg';
        }
        $collection->image = $file;

        $collection->save();

        return redirect()->route('collection.index');
    }

    public function index(){
        $collections = Collection::where('user_id', Auth::user()->id)->get();

        return view('collection.index',[
            'collections'=>$collections
        ]);
    }

    public function edit($id){
        $collection = Collection::find($id);

        return view('collection.edit', [
            'collection'=> $collection
        ]);
    }
}
