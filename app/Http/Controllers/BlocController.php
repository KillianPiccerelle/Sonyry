<?php

namespace App\Http\Controllers;

use App\Bloc;
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
            $file = $request->file('content');
        }

        $http  = HttpRequest::makeRequest('/blocs/'.$id , 'post' , $request->all() , $file);

        return redirect()->route('bloc.index', $http->object()->id);

    }

    public function update(Request $request, $id)
    {
        $bloc = Bloc::find($id);
        if (Auth::user()->can('update', $bloc)) {
            if ($request->input('title')) {
                $bloc->title = $request->input('title');
            } elseif ($request->input('content')) {
                $bloc->content = $request->input('content');
            }

            $bloc->save();
        }
        return redirect()->route('bloc.index', $bloc->page->id);
    }

    public function delete($id)
    {

        $bloc = Bloc::find($id);

        if (Auth::user()->can('delete', $bloc)) {
            if ($bloc->type == 'video') {
                $fileToDelete = 'public/bloc/' . $bloc->page_id . '/video/' . $bloc->content;

                if (Storage::exists($fileToDelete)) {
                    Storage::delete($fileToDelete);
                }
            } elseif ($bloc->type == 'image') {
                $fileToDelete = 'public/bloc/' . $bloc->page_id . '/image/' . $bloc->content;

                if (Storage::exists($fileToDelete)) {
                    Storage::delete($fileToDelete);
                }
            }
            elseif ($bloc->type == 'file'){
                $fileToDelete = 'public/bloc/' . $bloc->page_id . '/file/' . $bloc->content;
                if (Storage::exists($fileToDelete)) {
                    Storage::delete($fileToDelete);
                }
            }

            $bloc->delete();
        }

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
