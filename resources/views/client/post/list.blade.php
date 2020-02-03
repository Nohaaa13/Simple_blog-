@extends('admin.layouts.app')


@section('content')

    <form method="GET" action="">
        @include('client.partials._sort')
    </form>
    @include('client.post.partials._list', [ 'posts' => $posts ])

@endsection
