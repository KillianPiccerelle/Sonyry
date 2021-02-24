<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use App\User;
use App\Comment;
use App\Topic;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store (Request $request,$id)
    {
        $apiRequest = HttpRequest::makeRequest('/comments/'.$id.'/store','post',['content'=>$request->input('content')]);

        return redirect()->route('topics.show', $apiRequest->object()->id);
    }

    public function storeCommentReply(Request $request, $id)
    {
       $apiRequest = HttpRequest::makeRequest('/commentReply/'.$id.'/storeCommentReply','post',['replyComment'=>$request->input('replyComment')]);

       return redirect()->back();
    }

}
