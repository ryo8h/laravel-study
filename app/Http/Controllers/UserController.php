<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
/** storeメソッドの引数で使用 */
use App\Http\Requests\EditProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     *  プロフィールページのビューを呼び出す
     * @param プロフィールを表示するユーザのID
     */
    public function show(){
        $num = Request::input('userId');
        $user = User::where('id',$num)->first();
        $posts = Post::where('user_id',$num);
        if ($posts->doesntExist()) {
            return view('profile', [
                'user' => $user,
            ]);
        }
        $posts = Post::where('user_id', $num)->orderBy('created_at', 'desc')->paginate(10);
        return view('profile', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }

    /** プロフィール編集ページを呼び出す */
    public function index(){
        $is_image = false;
        if (Storage::disk('local')->exists('public/profile_images/' . Auth::id() . '.jpg')) {
            $is_image = true;
        }
        return view('profile/profileForm', ['is_image' => $is_image]);
    }

    /** プロフィール編集内容 */
    public function update(EditProfileRequest $request){
        $name = Request::input('name');
        $gender = Request::input('gender');
        if(!isset($gender)){
            return redirect('/home/profile/edit')->with('error', '性別を選択してください');
        }
        if (!empty($request->photo)) {
            $request->photo->storeAs('public/profile_images', Auth::id() . '.jpg');
        }
        $user = Auth::user();
        if(strcmp($user->name, $name)!=0 || strcmp($user->gender, $gender)!=0){
            // DB::table('users')->where('id', Auth::id())
            User::where('id', Auth::id())
            ->update(['name'=>$name, 'gender'=>$gender]);
        }
        return redirect('/home/profile/edit')->with('success', '新しいプロフィールを登録しました');
    }
}
