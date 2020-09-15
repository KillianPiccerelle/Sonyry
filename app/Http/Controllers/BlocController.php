<?php

namespace App\Http\Controllers;

use App\Bloc;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlocController extends Controller
{
    public function index($id){

        $page= Page::find($id);

        return view('page.bloc.index',[
            'page'=>$page
        ]);
    }


    public function create(Request $request, $id){

        $page= Page::find($id);

        $bloc = new Bloc();

        $type = $request->input('type');

        if ($type == 'text'){

            $bloc->text();

            $bloc->content = $request->input('content');

        }

        elseif ($type == 'script'){

            $bloc->script();

            $bloc->content = $request->input('content');
        }

        elseif ($type == 'image'){

            $bloc->image();

            if($request->file('content')) {

                $image = $request->file('content');

                $mimeType = $image->getClientMimeType();

                $imageFullName = $image->getClientOriginalName();
                $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $file = time(). '_' . $imageName . '.' . $extension;

                if (substr($mimeType, 0, 5) == 'image'){
                    $image->storeAs('public/bloc/'.$page->id.'/image', $file);
                    $bloc->content = $file;

                }
                else{
                    return redirect()->route('page.edit')->with('danger','Le fichier que vous essayer de joindre n\'est pas toléré');
                }

            }
            else{
                return redirect()->route('page.edit')->with('danger','Veuillez insérer un fichier image');
            }
        }

        elseif ($type == 'video') {

            $bloc->video();

            if ($request->file('content')) {

                $video = $request->file('content');

                $mimeType = $video->getClientMimeType();

                $fileFullname = $video->getClientOriginalName();
                $fileName = pathinfo($fileFullname , PATHINFO_FILENAME);
                $extension = $video->getClientOriginalExtension();
                $file = time(). '_'.$fileName.'.'.$extension;

                if (substr($mimeType, 0, 5) == 'video') {
                    $video->storeAs('public/bloc/'.$page->id.'/video/', $file);
                    $bloc->content = $file;
                } else {
                    return redirect()->route('page.edit')->with('danger','Le fichier que vous essayer de joindre n\'est pas toléré');
                }

            } else {
                return redirect()->route('page.edit')->with('danger','Veuillez insérer un fichier video');
            }
        }
        else{
            return redirect()->route('page.edit')->with('danger','Le type de bloc que vous essayer de créer est introuvable');
        }
        $bloc->page_id = $page->id;

        $bloc->title = $request->input('title');

        $bloc->save();

        return redirect()->route('page.edit',$page->id);
    }

    public function update($id){
        dd($id);
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
