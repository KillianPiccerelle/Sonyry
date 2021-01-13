<?php

namespace App\Http\Controllers;

use App\Bloc;
use App\CollectionsPage;
use App\ImageAction;
use App\Page;
use App\ShareGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pages = Page::where('user_id', Auth::user()->id)->get();

        return view('page.index', [
            'pages' => $pages,
            'title' => 'Mes pages'
        ]);
    }

    /**
     * Return the creation page view
     */
    public function create()
    {
        return view('page.create');
    }

    /**
     * @param Request $request
     * Store the page in the database
     */
    public function store(Request $request)
    {
        $page = new Page();

        $page->title = $request->input('title');
        $page->description = $request->input('description');
        $page->user_id = Auth::user()->id;

        if ($request->file('image')) {
            $image = $request->file('image');

            $imageAction = new ImageAction();

            $file = $imageAction->store($image, 'pages');


        } else {
            $file = 'default_page.png';
        }

        $page->image = $file;

        $page->save();

        return redirect()->route('page.index')->with('success', 'La page a bien été créée');
    }

    public function edit($id)
    {
        $page = Page::find($id);

        if (Auth::user()->can('update', $page)) {
            return view('page.edit', [
                'page' => $page,
            ]);
        }
        return redirect()->route('home')->with('danger', 'Vous n\'avez pas accès à cette page');
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);

        if (Auth::user()->can('update', $page)) {

            if ($request->input('title') != null) {
                $page->title = $request->input('title');
            }

            if ($request->input('description') != null) {
                $page->description = $request->input('description');
            }

            if ($request->file('image')) {

                /** update de l'image */

                /**  suppression de l'ancienne image */
                $fileToDelete = 'public/pages/' . Auth::user()->id . '/' . $page->image;

                $imageAction = new ImageAction();

                $imageAction->deleteImage($fileToDelete);

                $image = $request->file('image');

                $file = $imageAction->store($image, 'pages');

                $page->image = $file;
            }

            $page->save();

            return redirect()->route('page.edit', $page->id)->with('success', 'Les informations de la page ont bien été modifiées');

        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas modifier cette page');
    }

    /**
     *delete the page in the database
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        if (Auth::user()->can('delete', $page)) {

            CollectionsPage::where('page_id', $id)->delete();

            /** delete the page in the collection if they are in any collection */

            ShareGroup::where('page_id', $page->id)->delete();

            $blocs = Bloc::where('page_id',$page->id)->get();

            if (count($blocs)>0){
                foreach ($blocs as $bloc){
                    Bloc::deleteFromStorage($bloc);
                }
            }

            Bloc::where('page_id',$page->id)->delete();

            $fileToDelete = 'public/pages/' . Auth::user()->id . '/' . $page->image;

            $imageAction = new ImageAction();

            $imageAction->deleteImage($fileToDelete);

            $page->delete();

            return redirect()->route('page.index')->with('success', 'La page à bien été supprimée');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }

    public function show($id)
    {
        $page = Page::find($id);
        $blocs = Bloc::where('page_id', $page)->get();

        if (Auth::user()->can('view', $page)){
            return view('page.show', [
                'page' => $page,
                'blocs' => $blocs,
            ]);
        }
        return redirect()->route('home')->with('danger','Vous ne pouvez pas effectuer cette action');
    }
}
