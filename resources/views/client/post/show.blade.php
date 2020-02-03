@extends('admin.layouts.app')

@section('content')



    <div class="card">
            <div class="card col-12" >
                <div data-postid="{{ $post->id }}" class="card-body" >

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
                    <h6 class="card-subtitle mb-2 text-muted">{{  $post->users->name}} <a href="{{route('client.post.list',$post->users)}}">{{toDateFormat($post->created_at)}}</a></h6>
                    <p class="card-text">{!! $post->body !!} </p>
                    <span data-post="{{ $post->id }}" class="ml-3  spanlike">{{ $post->likes}}</span>
                    <div class="interaction">
                        <a href="#" data-location ="{{ route('client.post.like') }}" class="btn btn-xs btn-warning like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                    </div>
                </div>
            </div>
    </div>

    <div class="card">
        <div class="card comment" >
            <form method="POST" action="{{route('client.comment.create',$post)}}">
                @csrf
    <div class="row form-group CommentBody">
        <label class="PostBody__label col-md-4 col-form-label text-md-right" for="CommentBody">
            {{ __('user.field.bodyComment') }}<sup class="text-danger">*</sup>
        </label>
        <textarea id="CommentBody" name="CommentBody" class="col-6 form-control"  {{ $errors->has('CommentBody') ? ' is-invalid' : '' }}></textarea>
        @if ($errors->has('CommentBody'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('CommentBody') }}</strong>
            </span>
        @endif
    </div>

    <div class="submit form-group row mb-0 submitBtn">
        <div class="submitBtn__div col-md-6 offset-md-4">
            <button type="submit" class="submitBtn__button btn btn-outline-success">
                {{ __('user.action.addComment') }}
            </button>
        </div>
    </div>
            </form>
        </div>
        @foreach($comments as $comment)
            <div class="card col-12" >
                <div class="card-body " data-commentid="{{ $comment->id }}">

                    <h6 class="card-subtitle mb-2 text-muted">{{  $comment->users->name}} {{toDateFormat($comment->created_at)}}</h6>
                    <p class="card-text">{{ $comment->body}}  </p>
                    <span data-comment="{{ $comment->id }}" class="ml-3  spanlike">{{ $comment->likes}}</span>
                    <div class="interaction">
                        <a href="#" data-location ="{{ route('client.comment.like') }}" class="btn btn-xs btn-warning likeComment">{{ Auth::user()->commentsLikes()->where('comment_id', $comment->id)->first() ? Auth::user()->commentsLikes()->where('comment_id', $comment->id)->first()->like == 1 ? 'You like this comment' : 'Like' : 'Like'  }}</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="container">
            <div class="row justify-content-center">
                {{ $comments->appends($_GET)->links() }}
            </div>
        </div>
    </div>



    @include('partials.modal.modal')
@endsection
