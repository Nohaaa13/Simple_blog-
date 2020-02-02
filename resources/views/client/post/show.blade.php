@extends('client.layouts.app')

@section('content')

    <p>
        <a href="{{route('client.post.create')}}" class="btn btn-success ">{{ __('user.action.add') }}</a>
    </p>

    <div class="card">
            <div class="card col-12" >
                <div class="card-body">

                    <h5 class="card-title"> {{ $post->title}}
                        @if($post->isCreatedByActiveUser($post->id))
                        <span class="ml-3">
                           <a href="{{route('client.post.edit',$post)}}" class="fa fa-edit"></a>
                        </span>
                        <span class="ml-3">
                            <a href="#" data-title="{{ __('user.action.deleteModalTitle', ['name' =>  $post->title]) }}" data-body="false"
                               data-replace="{{ route('client.home') }}" data-toggle="modal" data-target="#modal"
                               data-location="{{ route('client.post.delete', $post) }}" class="fa fa-trash"></a>
                        </span>
                        @endif
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{  $post->users->name}} {{toDateFormat($post->created_at)}}</h6>
                    <p class="card-text">{!! $post->body !!} </p>
                    <span class="mr-3">{{  $post->likes}}
                            <a href="#" class="btn btn-success fa fa-thumbs-up"></a>
                        </span>
                </div>
            </div>
    </div>

    @include('partials.modal.modal')
@endsection
