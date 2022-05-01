<?php

namespace App\Http\Controllers;

use App\Collection;
use App\CollectionsPage;
use App\File;
use App\HttpRequest;
use App\ImageAction;
use App\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CollectionController extends Controller
{
    /**
     * @return Application|Factory|View
     * return the view to create a collection
     */
    public function create()
    {
        return view('collection.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * store the collection in the database
     */
    public function store(Request $request)
    {
        $file = null;

        if ($request->file('image')){
            $file = new File('image', $request->file('image') , $request->file('image')->getClientOriginalName() );
        }

        if (HttpRequest::makeRequest('/collections' , 'post' , $request->all() , $file)->object()){

            return redirect()->route('collection.index');
        }

        return redirect()->route('collection.create')->with('danger' , 'Une erreur est survenue veuillez réessayer');

    }

    /**
     * @return Application|Factory|View
     * return a view with all the collection of the user connected
     */
    public function index()
    {
        $collections = HttpRequest::makeRequest('/collections')->object();

        return view('collection.index', [
            'collections' => $collections
        ]);
    }


    /**
     * @param $id
     * @return Application|Factory|View
     * return a view with all page in the collection
     */
    public function edit($id)
    {
        $http = HttpRequest::makeRequest('/collections/'.$id);
        $collection = $http->object();

        if ($http->status() == 200){
            return view('collection.edit', [
                'collection' => $collection
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
        $file = null;



        if ($request->file('image')){
            $file = new File('image', $request->file('image') , $request->file('image')->getClientOriginalName() );
        }

        $http = HttpRequest::makeRequest('/collections/'.$id , 'post' , $request->all() , $file);

        if ($http->status() == 200){

            if ($http->object()){
                return redirect()->route('collection.edit', $id)->with('success', 'Les informations de la collection ont bien été modifiées');
            }
            return redirect()->route('collection.edit', $id)->with('danger', 'Une erreur est survenue veuillez réessayer');
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
        $http =  HttpRequest::makeRequest('/collections/'.$id , 'delete');

        if ($http->status() == 200){

            if ($http->object()){

                return redirect()->route('collection.index')->with('success', 'La collection a bien été supprimée');
            }
            return redirect()->route('collection.edit' , $id)->with('danger', 'Une erreur est survenue veuillez réessayer');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas supprimer cette collection');
    }


}
