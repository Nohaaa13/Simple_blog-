@extends('admin.layouts.app')


@section('content')

    <p>
        <a href="{{route('client.post.create')}}" class="btn btn-success ">{{ __('user.action.add') }}</a>
    </p>
    <form method="GET" action="">
    @include('client.post.form._filtration')
    @include('client.partials._sort')
    </form>
    @include('client.post.partials._list', [ 'posts' => $posts ])

    @include('partials.modal.modal')
@endsection
