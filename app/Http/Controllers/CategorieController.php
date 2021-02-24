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
        $cat = new Categorie();
        if (Auth::user()->can('update', $cat)) {
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

        request()->validate([
            'libelle' => 'required|min:5',
        ]);

        $categorie = new Categorie();

        $categorie->libelle = request()->input('libelle');

        if (Auth::user()->can('update', $categorie)) {

            $categorie->save();

            return redirect()->route('topics.index', $categorie->id);
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
        $categorie = Categorie::find($id);

        if (Auth::user()->can('delete', $categorie)) {

            if (count($categorie->topics) > 0) {
                foreach ($categorie->topics as $topic) {

                    if (count($topic->comments) > 0) {
                        foreach ($topic->comments as $comment) {
                            if (count($comment->comments) > 0) {
                                foreach ($comment->comments as $reply) {
                                    $reply->delete();
                                }
                            }
                            $comment->delete();
                        }
                    }

                    $topic->delete();
                }
            }

            $categorie->delete();

            return redirect()->route('categorie.index');
        }

        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }
}
