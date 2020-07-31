<?php

namespace App\Http\Controllers;

use App\Collection;
use App\CollectionsPage;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * return the view to create a collection
     */
    public function create(){
        $pages = Page::where('user_id', Auth::user()->id)->get();
        return view('collection.create',[
            'pages'=>$pages
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * store the collection in the database
     */
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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * return a view with all the collection of the user connected
     */
    public function index(){
        $collections = Collection::where('user_id', Auth::user()->id)->get();

        return view('collection.index',[
            'collections'=>$collections
        ]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * return a view with all page in the collection
     */
    public function edit($id){
        $collection = Collection::find($id);
        $pages = CollectionsPage::where('collection_id',$id)->get();

        return view('collection.edit', [
            'collection'=> $collection,
            'pages'=>$pages
        ]);
    }






}
