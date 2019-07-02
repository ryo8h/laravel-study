<?php

namespace App\Http\Controllers\Admin;

use Request;
use Illuminate\Support\Facades\DB;
/** storeメソッドの引数で使用 */
use App\Http\Requests\EditProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     *  ユーザのプロフィール
     */
    public function show(){
        $num = Request::input('userId');
        $user = User::where('id',$num)->first();
        $posts = Post::where('user_id',$num);
        if ($posts->doesntExist()) {
            return view('admin.profile', [
                'user' => $user,
            ]);
        }
        $posts = Post::where('user_id', $num)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.profile', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }

    /**
     *  アカウントリストのビュー
     */
    public function showAll(String $message = null){
        $users = User::paginate(10);
        return view('admin.userList', ['users' => $users, 'message' => $message]);
    }

    public function deleteUser(){
        $userId = Request::input('userId');
        $user = User::find($userId)->email;
        $message = $user."　を削除しました。";
        Post::where('user_id', $userId)->delete();
        User::destroy($userId);
        return self::showAll($message);
    }
}

//postsはCollectionオブジェクト
//delete()はModelオブジェクトに使える
//→postsをCollectionからModelオブジェクトにする
//→Collectionオブジェクトを一括削除できるメソッド
