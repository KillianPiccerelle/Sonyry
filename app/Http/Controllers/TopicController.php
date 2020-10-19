<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function __construct()

    {


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::latest('created_at')->simplepaginate(8);
        return view('topics.index', [
            'topics' => $topics
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('topics.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10',
        ]);

        $topic = auth()->user()->topics()->create([
            'title' => request('title'),
            'content' => request('content')
        ]);

        return redirect()->route('topics.show', $topic->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::find($id);
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

        $topic = Topic::find($id);
        if (Auth::user()->can('update', $topic)) {

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

        $topic = Topic::find($id);
        if (Auth::user()->can('update', $topic)) {

            $data = $request->validate([
                'title' => 'required|min:5',
                'content' => 'required|min:10'

            ]);

            $topic->update($data);

            return redirect()->route('topics.show', $topic->id);
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

        $topic = Topic::find($id);
        if (Auth::user()->can('delete', $topic)) {

            if (count($topic->comments) > 0) {
                foreach ($topic->comments as $comment) {
                    if(count($comment->comments) > 0 ) {
                        foreach ($comment->comments as $reply) {
                            $reply->delete();
                        }
                    }
                    $comment->delete();
                }
            }

            $topic->delete();
            return redirect()->route('topics.index');
        }
        return redirect()->route('topics.index')->with('danger', 'Vous ne pouvez pas supprimer ce topic');
    }
}
