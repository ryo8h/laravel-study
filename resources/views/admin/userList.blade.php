@extends('layouts.app_admin')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card shadow">
<div class="card-header bg-secondary text-white h5">ユーザリスト</div>
<div class="card-body">
@if (session('status'))
    <div class="alert alert-success" role="alert">
    {{ session('status') }}
    </div>
@endif

@if (isset($message))
<div class="alert alert-success">
    {{ $message }}
</div>
@endif

@foreach($users as $user)
    <div class="row justify-content-center mb-5  dropdown dropright "
        {{-- onclick="event.preventDefault(); document.getElementById('user-{{$user->id}}').submit();" --}}
        onmouseover="style.background='#EEE';"
        onmouseout="style.background='#FFF';">

        <div id="dropdownMenu"
            class="row btn-block dropdown-toggle "
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <div class="btn col-sm-3">　<!-- 写真 -->
                <div class = "float-right">
                    @if (Storage::disk('public')->exists('profile_images/'.$user->id.'.jpg'))
                        <img src={{asset('storage/profile_images/'.$user->id.'.jpg')}} width="70px" height="70px">
                    @else
                        <img src={{asset('storage/profile_images/default.jpg')}} width="70px" height="70px">
                    @endif
                </div>
            </div>
            <div class="btn col-sm-8"> <!-- 名前 -->
                <div class="row h4 ">{{$user->name}} </div>
                <div class="row h4 ">{{$user->email}} </div>
            </div>
        </div>
    <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenu">
        <button class="dropdown-item h5" type="button"
        onclick="event.preventDefault();
        document.getElementById('profile-page-{{$user->id}}').submit();">
        プロフィール</button>
        <button class="dropdown-item h5" type="button"
        data-toggle="modal" data-target="#deleteModal{{$user->id}}">
        削除</button>
    </ul>
<form id="profile-page-{{$user->id}}" action="{{ route('admin.profile') }}" method="GET" style="display: none;">
        <input name="userId" type="hidden" value={{$user->id}}>
    </form>

    <!-- モーダル(アカウント削除) -->
    <div class="modal fade"id="deleteModal{{$user->id}}"tabindex="-1"role="dialog"aria-labelledby="deleteModal{{$user->id}}"aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"id="myModalLabel">確認</h4>
                    </div>
                    <div class="modal-body">
                    <h3>{{$user->name}}を削除しますか？</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button"class="btn btn-default"data-dismiss="modal">閉じる</button>
                        <button type="button"class="btn btn-primary"
                        onclick="event.preventDefault();
                        document.getElementById('delete-user{{$user->id}}').submit();">
                        削除する</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <form id="delete-user{{$user->id}}" action="{{ route('deleteUser', ['userId'=>$user->id]) }}" method="POST" style="display: none;">
        @csrf
    </form>
@endforeach

<div class = "col-sm-8">
<div class = "float-right">
    {{ $users->links() }}
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
