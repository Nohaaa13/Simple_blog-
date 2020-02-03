<div class="card">
    @foreach($posts as $post)
        <div class="card col-12" >
            <div class="card-body likePost[{{ $post->id }}]" data-postid="{{ $post->id }}">

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
                <p class="card-text">{{ substr(strip_tags($post->body), 0, 70) }}  </p>
                <span data-post="{{ $post->id }}" class="ml-3  spanlike">{{ $post->likes}}</span>
                <div class="interaction">
                    <a href="#" data-location ="{{ route('client.post.like') }}" class="btn btn-xs btn-warning like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                </div>
                <a href="{{route('client.post.show',$post)}}" class="card-link">Show full</a>
            </div>
        </div>
    @endforeach
    <div class="container">
        <div class="row justify-content-center">
            {{ $posts->appends($_GET)->links() }}
        </div>
    </div>
</div>
