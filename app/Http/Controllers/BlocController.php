<?php

namespace App\Http\Controllers;

use App\Bloc;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlocController extends Controller
{
    public function index($id)
    {

        $page = Page::find($id);

        return view('page.bloc.index', [
            'page' => $page
        ]);
    }


    public function create(Request $request, $id)
    {

        $page = Page::find($id);



        if (Auth::user()->can('createBloc', $page)) {
            $bloc = new Bloc();

            $type = $request->input('type');

            if ($type == 'text') {

                $bloc->text();

                $bloc->content = $request->input('content');

            } elseif ($type == 'script') {

                $bloc->script();

                $bloc->content = $request->input('content');
            } elseif ($type == 'image') {

                $bloc->image();

                if ($request->file('content')) {

                    $image = $request->file('content');

                    $mimeType = $image->getClientMimeType();

                    $imageFullName = $image->getClientOriginalName();
                    $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();
                    $file = time() . '_' . $imageName . '.' . $extension;

                    if (substr($mimeType, 0, 5) == 'image') {
                        $image->storeAs('public/bloc/' . $page->id . '/image', $file);
                        $bloc->content = $file;

                    } else {
                        return redirect()->route('page.edit')->with('danger', 'Le fichier que vous essayer de joindre n\'est pas toléré');
                    }

                } else {
                    return redirect()->route('page.edit')->with('danger', 'Veuillez insérer un fichier image');
                }
            } elseif ($type == 'video') {

                $bloc->video();

                if ($request->file('content')) {

                    $video = $request->file('content');

                    $mimeType = $video->getClientMimeType();

                    $fileFullname = $video->getClientOriginalName();
                    $fileName = pathinfo($fileFullname, PATHINFO_FILENAME);
                    $extension = $video->getClientOriginalExtension();
                    $file = time() . '_' . $fileName . '.' . $extension;

                    if (substr($mimeType, 0, 5) == 'video') {
                        $video->storeAs('public/bloc/' . $page->id . '/video/', $file);
                        $bloc->content = $file;
                    } else {
                        return redirect()->route('page.edit')->with('danger', 'Le fichier que vous essayer de joindre n\'est pas toléré');
                    }

                } else {
                    return redirect()->route('page.edit')->with('danger', 'Veuillez insérer un fichier video');
                }
            }
            elseif($type == 'file') {
                $bloc->file();
                if ($request->file('content')) {

                    $fileInput = $request->file('content');

                    $size = $fileInput->getSize();


                    //dd(\Illuminate\Support\Facades\Request::server());

                    //if (1===1){
                        $fileFullName = $fileInput->getClientOriginalName();
                        $fileName = pathinfo($fileFullName, PATHINFO_FILENAME);
                        $extension = $fileInput->getClientOriginalExtension();
                        $file = time() . '_' . $fileName . '.' . $extension;
                    //}
                    $fileInput->storeAs('public/bloc/' . $page->id . '/file/', $file);
                    $bloc->content = $file;
                }

            }

            $bloc->page_id = $page->id;

            $bloc->title = $request->input('title');

            $bloc->save();

        }

        return redirect()->route('bloc.index', $page->id);

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
                $fileToDelete = 'public/bloc/' . $bloc->id . '/image/' . $bloc->content;

                if (Storage::exists($fileToDelete)) {
                    Storage::delete($fileToDelete);
                }
            }

            $bloc->delete();
        }

        return redirect()->route('bloc.index', $bloc->page->id);
    }

    public function text($id)
    {
        $page = Page::find($id);
        return view('page.bloc.text', [
            'page' => $page
        ]);
    }

    public function image($id)
    {
        $page = Page::find($id);
        return view('page.bloc.image', [
            'page' => $page
        ]);
    }

    public function video($id)
    {
        $page = Page::find($id);
        return view('page.bloc.video', [
            'page' => $page
        ]);
    }

    public function script($id)
    {
        $page = Page::find($id);
        return view('page.bloc.script', [
            'page' => $page
        ]);
    }

    public function file($id)
    {
        $page = Page::find($id);
        return view('page.bloc.file', [
            'page' => $page
        ]);
    }

}
