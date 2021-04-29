<?php

namespace App\Http\Controllers;

use App\Collection;
use App\CollectionsPage;
use App\HttpRequest;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionPageController extends Controller
{

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * return the view to manage the page in the collection
     */
    public function add($id)
    {
        $http = HttpRequest::makeRequest('/collectionPages/' . $id);

        if ($http->status() != 401) {

            $collection = $http->object();



            $count = 0;
            foreach ($collection->availables as $available){

                if (!$available->available){
                    unset($collection->availables[$count]);
                }

                $count++;
            }

            return view('collection.addPages', [
                'collection' => $collection]);
        }

        return redirect()->route('home')->with('danger', 'Vous n\'avez pas accès à cette collection');
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * store the added page in the collection in the database
     */
    public function store(Request $request, $id)
    {

        if ($request->input('checkbox') == null) {
            return redirect()->route('collection.addPages', $id)->with('danger', 'Veuillez séléctionner au minimum une page !');
        }

        $http = HttpRequest::makeRequest('/collectionPages/' . $id, 'post', $request->all());

        if ($http->status() != 401) {
            return redirect()->route('collection.addPages', $id)->with('success', 'Page(s) ajoutée(s) à la collection avec succès !');
        }

        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * delete the page to the collection
     */
    public function destroy(Request $request, $id)
    {
        if ($request->input('checkbox') == null) {
            return redirect()->route('collection.addPages', $id)->with('danger', 'Veuillez séléctionner au minimum une page !');
        }

        $http = HttpRequest::makeRequest('/collectionPages/delete/' . $id, 'post', $request->all());

        if ($http->status() != 401) {
            return redirect()->route('collection.addPages', $id)->with('success', 'Page(s) suprimée(s) de la collection avec succès !');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }
}
