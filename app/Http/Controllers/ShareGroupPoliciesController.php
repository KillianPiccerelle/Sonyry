<?php

namespace App\Http\Controllers;

use App\Group;
use App\Page;
use App\ShareGroup;
use App\ShareGroupPolicies;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShareGroupPoliciesController extends Controller
{
    public function edit($id, $page){
        $group = Group::find($id);

        $page = Page::find($page);

        if(Gate::denies('is-page-owner', $page)){
            return redirect()->route('home')->with('danger','Vous ne pouvez pas modifier les autorisations de cette page');
        }

        $members = $group->members;

        $share = ShareGroup::where('user_id', Auth::user()->id)->where('page_id', $page->id)->where('group_id',$group->id)->get();

        foreach ($members as $member){
            $policy = ShareGroupPolicies::where('share_group_id', $share[0]->id)->where('member_id', $member->user_id)->get();
            $member->policy = $policy;
        }

        return view('group.share.policies', [
           'group'=>$group,
           'page'=>$page,
            'members'=>$members
        ]);
    }

    public function store(Request $request, $id, $page, $member){

        $group = Group::find($id);

        $page = Page::find($page);

        if(Auth::user()->cannot('access', $page)) {
            return redirect()->route('home')->with('danger','Vous ne pouvez pas modifier les autorisations de cette page');
        }

        $member = User::find($member);

        $share = ShareGroup::where('user_id', Auth::user()->id)->where('page_id', $page->id)->where('group_id',$group->id)->get();


        $policy = ShareGroupPolicies::where('share_group_id', $share[0]->id)->where('member_id', $member->id)->get();

        if(count($policy) > 0){
            $policy = ShareGroupPolicies::find($policy[0]->id);
            if ($request->input('read') != null){
                $policy->read = $request->input('read');
            }
            else{
                $policy->read = 0;
            }
            if ($request->input('write') != null){
                $policy->write = $request->input('write');
            }
            else{
                $policy->write = 0;
            }
            if ($request->input('execute') != null){
                $policy->execute = $request->input('execute');
            }
            else{
                $policy->execute = 0;
            }

            $policy->save();
        }
        else{
            $policy = new ShareGroupPolicies();

            $policy->member_id = $member->id;

            $policy->share_group_id = $share[0]->id;

            if ($request->input('read') != null){
                $policy->read = $request->input('read');
            }
            if ($request->input('write') != null){
                $policy->write = $request->input('write');
            }
            if ($request->input('execute') != null){
                $policy->execute = $request->input('execute');
            }
            $policy->save();
        }

        return redirect()->route('policies.edit',['id'=>$group->id,'page'=>$page])->with('success','Les autorisations de '.$member->name.' sur la page '.$page->title.' ont bien été modifiées');


    }
}
