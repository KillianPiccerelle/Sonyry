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
     * Return view to create a collection
     */
    public function create(){
        return view('collection.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Store the collection database
     */
    public function store(Request $request){
        $collection = new Collection();

        $collection->name = $request->input('name');
        $collection->description = $request->input('description');
        $collection->user_id = Auth::user()->id;


        //Try if there is a file else it put a default picture
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
     * return the view of all the collections
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
     * return the view to edit a collection
     */
    public function edit($id){
        $collection = Collection::find($id);
        $pages = CollectionsPage::where('collection_id',$id)->get();

        return view('collection.edit', [
            'collection'=> $collection,
            'pages'=>$pages
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * return the view to edit the pages of the collection
     */
    public function addPages($id){
        $collection = Collection::find($id);

        $pagesInCollection = CollectionsPage::where('collection_id',$id)->get();
        $pagesAvailables = Page::where('user_id',Auth::user()->id)->get();

        $count = 0;

        //this foreach is here to check if the page are already in the collection
        foreach ($pagesAvailables as $page){
            foreach ($pagesInCollection as $pageChecking){
                if($pageChecking->page_id === $page->id){
                    unset($pagesAvailables[$count]);
                }
            }
            $count++;
        }

        return view('collection.addPages', [
            'collection'=>$collection,
            'pagesAvailables'=>$pagesAvailables,
            'pagesInCollection'=>$pagesInCollection
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * Store the page(s) in the collection
     */
    public function storePages(Request $request, $id){
        if($request->input('checkbox') == null){
            return redirect()->route('collection.addPages', $id)->with('danger','Veuillez séléctionner au minimum une page !');
        }
        foreach ($request->input('checkbox') as $item){
            $collectionPage = new CollectionsPage();

            $collectionPage->collection_id = $id;
            $collectionPage->page_id = $item;

            $collectionPage->save();
        }

        return redirect()->route('collection.addPages', $id)->with('success','Page(s) ajoutée(s) à la collection avec succès !');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * delete the page(s) in the collection
     */
    public function deletePages(Request $request, $id){
        if($request->input('checkbox') == null){
            return redirect()->route('collection.addPages', $id)->with('danger','Veuillez séléctionner au minimum une page !');
        }

        foreach ($request->input('checkbox') as $item){

            $collectionPage = CollectionsPage::where('page_id',$item);
            $collectionPage->delete();
        }

        return redirect()->route('collection.addPages', $id)->with('success','Page(s) suprimée(s) de la collection avec succès !');
    }
}
