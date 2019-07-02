@if(session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif

@foreach ($posts as $post)
    <div class="row align-items-start mb-5 mx-md-3 dropdown dropright"
    onmouseover="style.background='#EEE';"
    onmouseout="style.background='#FFF';">
    　  <!-- 写真 -->
        <div class="col-sm-3"
        onclick="event.preventDefault(); document.getElementById('profile-page-{{$post->id}}').submit();">
            <div class = "float-right">
            @if (Storage::disk('public')->exists('profile_images/'.$post->user_id.'.jpg'))
                <img src={{asset('storage/profile_images/'.$post->user_id.'.jpg')}} width="70px" height="70px">
            @else
                <img src={{asset('storage/profile_images/default.jpg')}} width="70px" height="70px">
            @endif
            </div>
        </div>
        <!-- 投稿内容 -->
        <div class="col-sm-7"
        onclick="event.preventDefault(); document.getElementById('profile-page-{{$post->id}}').submit();">
            <div class="row h4 text-primary">{{$post->user->name}} </div>
            <div class="row h5">{{$post->message}}</div>
            <div class="row text-muted">{{$post->created_at}}</div>
        </div>
        <!-- メニュー -->
        <div id="dropdownMenu" class="col-sm-2 row btn-block dropdown-toggle "
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src={{asset('storage/profile_images/menu2.png')}} width="20px" height="20px">
        </div>
        <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenu">
            <button class="dropdown-item h5" type="button"
            onclick="event.preventDefault();
            document.getElementById('profile-page-{{$post->id}}').submit();">
            プロフィール</button>
            <button class="dropdown-item h5" type="button"
            data-toggle="modal" data-target="#deleteModal{{$post->id}}">
            削除</button>
        </ul>
    </div>
    <form id="profile-page-{{$post->id}}" action="{{ route('admin.profile') }}" method="GET" style="display: none;">
            <input name="userId" type="hidden" value={{$post->user_id}}>
    </form>

    <!-- モーダル(アカウント削除) -->
    <div class="modal fade"id="deleteModal{{$post->id}}"tabindex="-1"role="dialog"aria-labelledby="deleteModal{{$post->id}}"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"id="myModalLabel">確認</h4>
                </div>
                <div class="modal-body">
                <h3>{{$post->message}}<br />を削除しますか？</h3>
                </div>
                <div class="modal-footer">
                    <button type="button"class="btn btn-default"data-dismiss="modal">閉じる</button>
                    <button type="button"class="btn btn-primary"
                    onclick="event.preventDefault();
                    document.getElementById('delete-post{{$post->id}}').submit();">
                    削除する</button>
                </div>
            </div>
        </div>
    </div>
    <form id="delete-post{{$post->id}}" action="{{ route('deletePost', ['postId'=>$post->id]) }}" method="POST" style="display: none;">
        @csrf
    </form>
@endforeach
