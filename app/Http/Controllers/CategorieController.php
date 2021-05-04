<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\HttpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiRequest = HttpRequest::makeRequest('/categorie/index');
        if ($apiRequest->status() != 401){
            $categories = $apiRequest->object()->categories;
            return view('categorie.index', [
                'categories' => $categories
            ]);
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apiRequest = HttpRequest::makeRequest('/categorie/create');

        if ($apiRequest->status() != 401){
            return view('categorie.create');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apiRequest = HttpRequest::makeRequest('/categorie/store','post',$request->all());

        if ($apiRequest->status() != 401){
            return redirect()->route('topics.index');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apiRequest = HttpRequest::makeRequest('/categorie/'.$id.'/destroy','delete');
        //dd($apiRequest->status());
        if ($apiRequest->status() != 401){

            return redirect()->route('categorie.index')->with('success', 'Categorie supprimée');
        }

        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }
}
