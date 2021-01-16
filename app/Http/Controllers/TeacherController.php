<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Page;
use App\Role;
use App\RoleUser;
use App\RoleUserPolicy;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(){

        $rolePolicy = new RoleUserPolicy();
        if ($rolePolicy->role($rolePolicy->getJury()) || $rolePolicy->role($rolePolicy->getTeacher())){
            $users = RoleUser::where('role_id', 1 )->get();
            return view('teacher.index', [
                'users' => $users
            ]);
        }

        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');

    }

    public function viewPagesUser($id)
    {

        $rolePolicy = new RoleUserPolicy();
        if ($rolePolicy->role($rolePolicy->getJury()) || $rolePolicy->role($rolePolicy->getTeacher())){
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
