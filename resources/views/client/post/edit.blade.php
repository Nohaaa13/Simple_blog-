@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ $pageTitle }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 offset-md-4">
                    @include('partials.form.markerRequireFields')
                </div>
            </div>

            <form method="POST" action="">
                @csrf
                @include('client.partials._postForm', ['buttonTitle' => __('user.action.update') ,'post' => $post ])
            </form>
        </div>
    </div>


@endsection
