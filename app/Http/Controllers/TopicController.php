<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\HttpRequest;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiRequest = HttpRequest::makeRequest('/topics');

        //dd($apiRequest->object());

        $topics = $apiRequest->object()->topics->data;
        $categories = $apiRequest->object()->categories;

        return view('topics.index', [
            'topics' => $topics,
            'categories' => $categories
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apiRequest = HttpRequest::makeRequest('/topics/create');

        $categories = $apiRequest->object()->categories ;

        return view('topics.create', [
            'categories' => $categories
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apiRequest = HttpRequest::makeRequest('/topics/store','post',['title'=>$request->input('title'),'categorie_id'=>$request->input('categorie_id'),'content'=>$request->input('content')]);


        return redirect()->route('topics.show',$apiRequest->object()->id)->with('success','Création du topic avec succès');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apiRequest = HttpRequest::makeRequest('/topics/'.$id.'/show');

        $topic = $apiRequest->object()->topic;

        return view('topics.show', [
            'topic' => $topic
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apiRequest = HttpRequest::makeRequest('/topics/'.$id.'/edit');

        if ($apiRequest->status() != 401){

            $topic = $apiRequest->object()->topic;

            return view('topics.edit', [
                'topic' => $topic
            ]);

        }

        return redirect()->route('topics.index')->with('danger', 'Vous ne pouvez pas modifier ce topic');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = ['title'=>$request->input('title'),'categorie_id'=>$request->input('categorie_id'),'content'=>$request->input('content')];

        $apiRequest = HttpRequest::makeRequest('/topics/'.$id.'/update','put',$params);

        if ($apiRequest->status() != 401){

            $topic = $apiRequest->object()->topic;

            return redirect()->route('topics.show', $topic->id)->with('success','Topic mis à jour');
        }

        return redirect()->route('topics.index')->with('danger', 'Vous ne pouvez pas modifier ce topic');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apiRequest = HttpRequest::makeRequest('/topics/'.$id.'/destroy','delete');

        if ($apiRequest->status() != 401){

            return redirect()->route('topics.index')->with('success', 'Topic supprimé');

        }
        return redirect()->route('topics.index')->with('danger', 'Vous ne pouvez pas supprimer ce topic');
    }
}
