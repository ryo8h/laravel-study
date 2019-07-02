@extends('layouts.app')
@section('content')

<div class="container">
        <div class="row justify-content-center"> <!-- 中央寄せ -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white h5">プロフィール</div>
                    <div class="card-body">
                        <figure>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (Storage::disk('public')->exists('profile_images/'.$user->id.'.jpg'))
                                <img src={{asset('storage/profile_images/'.$user->id.'.jpg')}} width="100px" height="100px">
                            @else
                                <img src={{asset('storage/profile_images/default.jpg')}} width="100px" height="100px">
                            @endif
                            {{-- <figcaption>現在のプロフィール画像</figcaption> --}}
                        </figure>
                        <p>名前 : {{ $user->name }}</p>
                        <p>メール : {{ $user->email }}</p>
                        <p>性別 :
                            @switch ( $user->gender )
                                @case(0)
                                    未設定
                                    @break
                                @case(1)
                                    男性
                                    @break
                                @case(2)
                                    女性
                                    @break
                                @case(9)
                                    規格外
                                    @break
                            @endswitch
                        </p>
                        <p>登録日 : {{ $user->created_at }}</p>
                        @if(AUth::id() == $user->id)
                        <div class="col-5 float-right">
                            <form  action="{{ route('editProfile') }}" method="GET">
                                <button type="submit" class="btn btn-primary btn-block">変更</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-info text-white h5">今までの投稿</div>
                    <div class="card-body">
                        @if(isset($posts))
                            @include('timeline')
                            <div class = "col-sm-8">
                                <div class = "float-right">
                                    {{ $posts->appends (['userId'=>$posts[0]->user_id]) ->links() }}
                                </div>
                            </div>
                        @else
                            <p>まだ投稿がありません。</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
