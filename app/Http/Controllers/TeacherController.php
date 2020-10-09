<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Page;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(){

        $users = User::where('role_id', 1 )->get();

        return view('teacher.index', [
            'users' => $users
        ]);
    }

    public function viewPagesUser($id)
    {
        $user = User::find($id);

        $pages = Page::where('user_id', $user->id)->get();
        //dd($pages);
        return view('page.index', [
            'pages' => $pages,
            'title' => 'Des pages'
        ]);
    }

}
