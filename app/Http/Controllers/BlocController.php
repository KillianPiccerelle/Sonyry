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


    public function create($id){

        $page= Page::find($id);

        $bloc = new Bloc();

        $bloc->page_id = $page->id;

        $bloc->type = "";

        $bloc->content = "";

        $bloc->save();

        return redirect()->route('bloc.index',$page->id);
    }
}
