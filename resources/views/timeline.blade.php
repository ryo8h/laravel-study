@foreach ($posts as $post)
    <div class="row align-items-start mb-5 mx-md-3"
    onclick="event.preventDefault(); document.getElementById('profile-page-{{$post->id}}').submit();"
    onmouseover="style.background='#EEE';"
    onmouseout="style.background='#FFF';">
        <div class="col-sm-3">　<!-- 写真 -->
            <div class = "float-right">
            @if (Storage::disk('public')->exists('profile_images/'.$post->user_id.'.jpg'))
                <img src={{asset('storage/profile_images/'.$post->user_id.'.jpg')}} width="70px" height="70px">
            @else
                <img src={{asset('storage/profile_images/default.jpg')}} width="70px" height="70px">
            @endif
            </div>
        </div>
        <div class="col-sm-8"> <!-- 投稿内容 -->
            <div class="row h4 text-primary">{{$post->user->name}} </div>
            <div class="row h5">{{$post->message}}</div>
            <div class="row text-muted">{{$post->created_at}}</div>
        </div>
    </div>
    <form id="profile-page-{{$post->id}}" action="{{ route('profile') }}" method="GET" style="display: none;">
            <input name="userId" type="hidden" value={{$post->user_id}}>
    </form>
@endforeach
