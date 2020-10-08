<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){


        $users = User::where('role_id', 1 )->get();

        return view('teacher.index', [
            'users' => $users
        ]);
    }
}
