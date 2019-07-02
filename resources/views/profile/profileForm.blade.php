@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white h5">編集</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if ($is_image)
                        <figure>
                            <img src={{asset('storage/profile_images/'.Auth::id().'.jpg')}} width="100px" height="100px">
                            <figcaption>現在のプロフィール画像</figcaption>
                        </figure>
                    @endif
                    <form method="POST" action="{{ route('editProfile') }}" enctype="multipart/form-data" >
                        @csrf
                        {{-- 写真 --}}
                        <div class="form-group row col-md-4 col-form-label center-block">
                            <input type="file" name="photo" >
                        </div>
                        {{-- 名前 --}}
                        <div class="form-group row ">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="{{ old('name') }}" value="{{ Auth::user()->name }}" autocomplete="name">
                            </div>
                        </div>
                        {{-- 性別 --}}
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">性別</label>
                            <div class="col-md-6">
                                <select name="gender">
                                    @if(Auth::user()->gender == '0')
                                        <option value="" disabled selected="selected" >選択してください</option>
                                    @endif
                                    <option value="1" @if(Auth::user()->gender == '1') selected @endif>男性</option>
                                    <option value="2" @if(Auth::user()->gender == '2') selected @endif>女性</option>
                                    <option value="9" @if(Auth::user()->gender == '9') selected @endif>非公開</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    更新する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
