<?php

namespace App\Http\Controllers;

use App\Bloc;
use App\CollectionsPage;
use App\File;
use App\HttpRequest;
use App\ImageAction;
use App\Page;
use App\ShareGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{

    public function index()
    {

        $http = HttpRequest::makeRequest('/pages');

        $pages = $http->object();


        return view('page.index', [
            'pages' => $pages,
            'title' => 'Mes pages'
        ]);
    }

    /**
     * Return the creation page view
     */
    public function create()
    {
        return view('page.create');
    }

    /**
     * @param Request $request
     * Store the page in the database
     */
    public function store(Request $request)
    {
        $file = null;
        if ($request->file('image')) {
            $file = new File('image' , $request->file('image') , $request->file('image')->getClientOriginalName());
        }

        $http = HttpRequest::makeRequest('/pages' , 'post' , $request->all() , $file);

        if ($http->status() !== 500){
            return redirect()->route('page.index')->with('success', 'La page a bien été créée');
        }
        return redirect()->route('page.index')->with('danger', 'Une erreur est survenue veuillez réessayer');

    }

    public function edit($id)
    {
        $http = HttpRequest::makeRequest('/pages/edit/'.$id);

        if ($http->status() !== 401) {

            $page = $http->object();

            return view('page.edit', [
                'page' => $page,
            ]);
        }
        return redirect()->route('home')->with('danger', 'Vous n\'avez pas accès à cette page');
    }

    public function update(Request $request, $id)
    {
        $file = null;

        if ($request->file('image')){
            $file = new File('image', $request->file('image') , $request->file('image')->getClientOriginalName() );
        }


        $http = HttpRequest::makeRequest('/pages/'.$id , 'post' , $request->all() , $file);


        if ($http->status() !== 401){

            $page = $http->object();

            return redirect()->route('page.edit', $page->id)->with('success', 'Les informations de la page ont bien été modifiées');

        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas modifier cette page');
    }

    /**
     *delete the page in the database
     */
    public function destroy($id)
    {
        $http = HttpRequest::makeRequest('/pages/'.$id , 'delete');

        if ($http->status() != 401){
            return redirect()->route('page.index')->with('success', 'La page à bien été supprimée');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }

    public function show($id)
    {
        $http = HttpRequest::makeRequest('/pages/'.$id);

        if ($http->status() !== 401) {

            $page = $http->object();

            return view('page.show', [
                'page' => $page,
            ]);
        }
        return redirect()->route('home')->with('danger', 'Vous n\'avez pas accès à cette page');
    }
}
