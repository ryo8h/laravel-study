@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white h5">タイムライン</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(isset($posts))
                        @include('admin.timeline')
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
    </div>
</div>
@endsection
