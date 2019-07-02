@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white h5">タイムライン</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(isset($posts))
                        @include('timeline')
                        <div class = "col-sm-8">
                            <div class = "float-right">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    @else
                        <p>まだ投稿がありません。</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white h5">投稿フォーム</div>
                <div class="card-body">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    <form action="{{ route('post') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="4"></textarea>
                        </div>
                        <div class="col-5 float-right">
                            <button type="submit" class="btn btn-outline-primary btn-block">投稿</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
