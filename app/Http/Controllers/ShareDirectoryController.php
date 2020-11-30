<?php

namespace App\Http\Controllers;

use App\Group;
use App\ShareDirectory;
use Illuminate\Http\Request;

class ShareDirectoryController extends Controller
{
    public function store(Request $request, $id){
        $group = Group::find($id);

        if ($request->input('name') != null){
            $directory = new ShareDirectory();

            $directory->name = $request->input('name');
            $directory->group_id = $id;

            $directory->save();
        }

        return redirect()->route('group.share',$group->id);
    }
}
