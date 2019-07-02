<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Post::doesntExist()) {
            return view('admin.home');
        }else{
            $posts = Post::orderBy('id', 'desc')->paginate(10);
            return view('admin.home', [
                'posts'=>$posts,
            ]);
        }
    }
}
