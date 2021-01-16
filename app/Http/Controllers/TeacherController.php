<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Page;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(){

        if (Auth::user()->can('view',Auth::user())){
            $users = RoleUser::where('role_id', 1 )->get();
            return view('teacher.index', [
                'users' => $users
            ]);
        }

        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');

    }

    public function viewPagesUser($id)
    {

        if (Auth::user()->can('view',Auth::user())){
            $user = User::find($id);
            $pages = Page::where('user_id', $user->id)->get();
            return view('page.index', [
                'pages' => $pages,
                'title' => 'Des pages'
            ]);
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');
    }

}
