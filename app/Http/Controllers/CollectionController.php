<?php

namespace App\Http\Controllers;

use App\Collection;
use App\CollectionsPage;
use App\ImageAction;
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
    public function create()
    {
        $pages = Page::where('user_id', Auth::user()->id)->get();

            return view('collection.create', [
                'pages' => $pages
            ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * store the collection in the database
     */
    public function store(Request $request)
    {
        $collection = new Collection();

        $collection->name = $request->input('name');
        $collection->description = $request->input('description');
        $collection->user_id = Auth::user()->id;


        if ($request->file('image')) {

            $imageAction = new ImageAction();

            $image = $request->file('image');

            $file = $imageAction->store($image, 'collections');


        } else {
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
    public function index()
    {
        $collections = Collection::where('user_id', Auth::user()->id)->get();

        return view('collection.index', [
            'collections' => $collections
        ]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * return a view with all page in the collection
     */
    public function edit($id)
    {
        $collection = Collection::find($id);

        if (Auth::user()->can('update', $collection)) {
            $pages = CollectionsPage::where('collection_id', $id)->get();

            return view('collection.edit', [
                'collection' => $collection,
                'pages' => $pages
            ]);
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas gérer les pages de cette collection collection');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * update the collection informations
     */
    public function update(Request $request, $id)
    {

        $collection = Collection::find($id);

        if (Auth::user()->can('update', $collection)) {

            if ($request->input('name') != null) {
                $collection->name = $request->input('name');
            }
            if ($request->input('description') != null) {
                $collection->description = $request->input('description');
            }
            if ($request->file('image')) {
                //delete old image
                $fileToDelete = 'public/collections/' . Auth::user()->id . '/' . $collection->image;

                $image = $request->file('image');

                $imageAction = new ImageAction();

                //Delete the old image
                $imageAction->deleteImage($fileToDelete);

                //Add the new image

                $collection->image = $imageAction->store($image,'collections');
            }
            $collection->save();

            return redirect()->route('collection.edit', $collection->id)->with('success', 'Les informations de la collection ont bien été modifiées');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas modifier cette collection');

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * delete the collection of the database
     */
    public function destroy($id)
    {
        $collection = Collection::find($id);

        if (Auth::user()->can('delete', $collection)) {

            // delete all the link between the page in the collection and the colletion

            $collectionPage = CollectionsPage::where('collection_id', $collection->id)->delete();

            $imageAction = new ImageAction();

            $fileToDelete = 'public/collections/' . Auth::user()->id . '/' . $collection->image;

            $imageAction->deleteImage($fileToDelete);

            $collection->delete();

            return redirect()->route('collection.index')->with('success', 'La collection a bien été supprimée');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas supprimer cette collection');
    }


}
