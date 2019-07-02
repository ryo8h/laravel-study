<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{



    public function __construct(){
        $this->middleware('auth');
    }

    /** 投稿　POST */
    public function postMessage(Request $request){
        if(($request->input('message')) == null){
            return redirect('home')->with('error' , '何か入力してください。');
        }
        $post = new Post;
        $post->message = $request->input('message');
        $post->user_id = Auth::id();
        $post->save();
        //dbに投稿内容をインサート
        return redirect('home');
    }
}
