<?php

namespace App\Http\Controllers;

use App\Collection;
use App\CollectionsPage;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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

        if (Gate::denies('is-collection-owner', $collection)){
            return redirect()->route('home')->with('danger','Vous ne pouvez pas gérer les pages de cette collection collection');
        }

        $pages = CollectionsPage::where('collection_id',$id)->get();

        return view('collection.edit', [
            'collection'=> $collection,
            'pages'=>$pages
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * update the collection informations
     */
    public function update(Request $request, $id){

        $collection = Collection::find($id);

        if (Gate::denies('is-collection-owner', $collection)){
            return redirect()->route('home')->with('danger','Vous ne pouvez pas modifier cette collection');
        }

        if($request->input('name') != null){
            $collection->name = $request->input('name');
        }
        if($request->input('description') != null){
            $collection->description = $request->input('description');
        }
        if($request->file('image')){
            //image update
            //delete old image
            $fileToDelete = 'public/collections/'.Auth::user()->id.'/'.$collection->image;

            if(Storage::exists($fileToDelete)){
                Storage::delete($fileToDelete);
            }
            $image = $request->file('image');
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $file = time(). '_' . $imageName . '.' . $extension;
            $image->storeAs('public/collections/'.Auth::user()->id, $file);
            $collection->image = $file;
        }
        $collection->save();

        return redirect()->route('collection.edit', $collection->id)->with('success', 'Les informations de la collection ont bien été modifiées');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * delete the collection of the database
     */
    public function destroy($id){

        $collection = Collection::find($id);

        if (Gate::denies('is-collection-owner', $collection)){
            return redirect()->route('home')->with('danger','Vous ne pouvez pas supprimer cette collection');
        }

        // delete all the link between the page in the collection and the colletion
        $collectionPage = CollectionsPage::where('collection_id',$collection->id)->get();
        if(count($collectionPage)>0){
            foreach ($collectionPage as $item){
                $item->delete();
            }
        }

        $fileToDelete = 'public/collections/'.Auth::user()->id.'/'.$collection->image;

        if(Storage::exists($fileToDelete)){
            Storage::delete($fileToDelete);
        }

        $collection->delete();

        return redirect()->route('collection.index')->with('success','La collection a bien été supprimée');
    }






}
