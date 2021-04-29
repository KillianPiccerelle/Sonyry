<?php

namespace App\Http\Controllers;

use App\Bloc;
use App\File;
use App\HttpRequest;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BlocController extends Controller
{

    public function index($id)
    {

        $http = HttpRequest::makeRequest('/blocs/'.$id);

        $page = $http->object();

        return view('page.bloc.index', [
            'page' => $page
        ]);
    }

    public function create(Request $request, $id)
    {

        $file = null;

        if ($request->file('content')){
            $file = new File('content' , $request->file('content') , $request->file('content')->getClientOriginalName());
        }

        $http  = HttpRequest::makeRequest('/blocs/'.$id , 'post' , $request->all() , $file);

        return redirect()->route('bloc.index', $http->object()->id);

    }

    public function update(Request $request, $id)
    {

        $http = HttpRequest::makeRequest('/blocs/'.$id , 'put' , $request->all());

        $bloc = $http->object();

        return redirect()->route('bloc.index', $bloc->page->id);
    }

    public function delete($id)
    {

        $http = HttpRequest::makeRequest('/blocs/'.$id , 'delete');

        $bloc = $http->object();

        return redirect()->route('bloc.index', $bloc->page->id);
    }

    public function text()
    {

        return view('page.bloc.text');
    }

    public function image()
    {

        return view('page.bloc.image');
    }

    public function video()
    {

        return view('page.bloc.video');
    }

    public function script(){

        return view('page.bloc.script');
    }

    public function file()
    {
        return view('page.bloc.file');
    }

}
