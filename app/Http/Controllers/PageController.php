<?php

namespace App\Http\Controllers;

use App\Bloc;
use App\CollectionsPage;
use App\Page;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $file = time() . '_' . $imageName . '.' . $extension;
            $image->storeAs('public/pages/' . Auth::user()->id, $file);

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
            return redirect()->route('home')->with('danger', 'Vous n\'avez pas accès à cette page');
        }
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

                if (Storage::exists($fileToDelete)) {
                    Storage::delete($fileToDelete);
                }
                $image = $request->file('image');
                $imageFullName = $image->getClientOriginalName();
                $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $file = time() . '_' . $imageName . '.' . $extension;
                $image->storeAs('public/pages/' . Auth::user()->id, $file);
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

            $collectionPage = CollectionsPage::where('page_id', $id)->get();

            /** delete the page in the collection if they are in any collection */
            if (count($collectionPage) > 0) {
                foreach ($collectionPage as $item) {
                    $item->delete();
                }
            }

            $fileToDelete = 'public/pages/' . Auth::user()->id . '/' . $page->image;

            if (Storage::exists($fileToDelete)) {
                Storage::delete($fileToDelete);
            }

            $page->delete();

            return redirect()->route('page.index')->with('success', 'La page à bien été supprimée');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas supprimer cette page');
    }

    public function show($id)
    {

    }
}
