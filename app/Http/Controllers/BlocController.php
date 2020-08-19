<?php

namespace App\Http\Controllers;

use App\Bloc;
use App\Page;
use Illuminate\Http\Request;

class BlocController extends Controller
{
    public function index($id){


        $page= Page::find($id);


        return view('page.bloc.index',[
            'page'=>$page
        ]);
    }


    public function create(Request $request, $id){

        dd($request);

        $page= Page::find($id);

        $bloc = new Bloc();

        $bloc->page_id = $page->id;

        $bloc->content = "";

        $bloc->save();

        return redirect()->route('bloc.index',$page->id);
    }

    public function text($id){
        $page = Page::find($id);
        return view('page.bloc.text',[
            'page'=>$page
        ]);
    }

    public function image($id){
        $page = Page::find($id);
        return view('page.bloc.image',[
            'page'=>$page
        ]);
    }

    public function video($id){
        $page = Page::find($id);
        return view('page.bloc.video',[
            'page'=>$page
        ]);
    }

    public function script($id){
        $page = Page::find($id);
        return view('page.bloc.script',[
            'page'=>$page
        ]);
    }
}
