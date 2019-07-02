<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{



    public function __construct(){
        $this->middleware('auth');
    }

    /** 投稿削除　POST */
    public function deletePost(Request $request){
        Post::destroy($request->input('postId'));
        return redirect('admin/home')->with('message', '投稿を削除しました。');
    }
}
