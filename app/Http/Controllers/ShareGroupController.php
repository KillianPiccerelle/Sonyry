<?php

namespace App\Http\Controllers;

use App\Group;
use App\ShareDirectory;
use App\ShareGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShareGroupController extends Controller
{
    public function indexPage(){
        $pages = Auth::user()->pages;

        $groups = Auth::user()->groupsMember;

        $shares = Auth::user()->sharesGroups;


        foreach ($pages as $page){
            $page->groups = $page->user->groupsMember;

            foreach ($page->groups as $group){
                $group->status = false;
                foreach ($shares as $share){
                    if ($group->group->id === $share->group_id && $page->id === $share->page_id ){
                        $group->status = true;
                    }
                }

            }

        }


        return view('share.indexPage',[
            'pages'=>$pages
        ]);
    }


    public function sharePage(Request $request, $id){

        if ($request->input('group') === null){
            return redirect()->route('share.indexPage')->with('danger','Veuillez séléctionner au moins un groupe');
        }

        foreach ($request->input('group') as $group){
            $group = Group::find($group);
            if (Gate::allows('is-member-group', $group )){
                if (count(ShareGroup::where('group_id',$group->id)->where('page_id',$id)->get()) > 0){

                }
                else {
                    $shareGroup = new ShareGroup();

                    $shareGroup->user_id = Auth::user()->id;

                    $shareGroup->page_id = $id;

                    $shareGroup->group_id = $group->id;

                    $shareDirectory = new ShareDirectory();

                    if($shareDirectory->haveDirectory(Auth::user()->id,$group->id)){

                    }
                    else{
                        $shareDirectory->name = Auth::user()->name;
                        $shareDirectory->user_id = Auth::user()->id;
                        $shareDirectory->group_id = $group->id;

                        $shareDirectory->save();
                    }
                    $shareGroup->save();
                }
            }

        }

        return redirect()->route('share.indexPage')->with('success','Page(s) partagée(s) avec succès');
    }
}
