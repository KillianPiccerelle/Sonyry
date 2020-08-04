<?php

namespace App\Http\Controllers;

use App\ShareDirectory;
use App\ShareGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareGroupController extends Controller
{
    public function sharePage(Request $request, $id){
        if ($request->input('checkbox') == null){
            return redirect()->route('page.edit', $id)->with('danger','Veuillez séléctionnez au moins un groupe pour partager cette page');
        }

        foreach ($request->input('checkbox') as $share){

            $shareGroup = new ShareGroup();

            $shareGroup->user_id = Auth::user()->id;

            $shareGroup->page_id = $id;

            $shareGroup->group_id = $share;

            $shareDirectory = new ShareDirectory();

            if($shareDirectory->haveDirectory(Auth::user()->id,$share)){

            }
            else{
                $shareDirectory->name = Auth::user()->name;
                $shareDirectory->user_id = Auth::user()->id;
                $shareDirectory->group_id = $share;

                $shareDirectory->save();
            }

            $shareGroup->save();




        }

        return redirect()->route('page.edit',$id)->with('success','Les pages ont bien été partagées');
    }
}
