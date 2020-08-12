<?php

namespace App\Http\Controllers;

use App\ShareDirectory;
use App\ShareGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareGroupController extends Controller
{
    public function indexPage(){
        $pages = Auth::user()->pages;

        $groups = Auth::user()->groups;

        dd($groups);

        foreach ($pages as $page){
            $page->groups = $groups;

        }

        return view('share.indexPage',[
            'pages'=>$pages
        ]);
    }


    public function sharePage(Request $request, $id){

        if (count(ShareGroup::where('group_id', $request->input('group'))->where('page_id', $id)->get()) > 0){
            return redirect()->route('share.indexPage')->with('danger','La page que vous essayer de partager est déjà présente dans le groupe');
        }
        $shareGroup = new ShareGroup();

        $shareGroup->user_id = Auth::user()->id;

        $shareGroup->page_id = $id;

        $shareGroup->group_id = $request->input('group');

        $shareDirectory = new ShareDirectory();

        if($shareDirectory->haveDirectory(Auth::user()->id,$request->input('group'))){

        }
        else{
            $shareDirectory->name = Auth::user()->name;
            $shareDirectory->user_id = Auth::user()->id;
            $shareDirectory->group_id = $request->input('group');

            $shareDirectory->save();
        }

        $shareGroup->save();

        return redirect()->route('share.indexPage')->with('success','La pages a bien été partagée avec succès');
    }
}
