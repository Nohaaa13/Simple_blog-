<?php

namespace App\Http\Controllers\Client;

use App\Entity\CommentLikes;
use App\Entity\Comments;
use App\Entity\Posts;
use App\Http\Controllers\Controller;
use App\Services\CommentServices;
use App\Services\Dto\CommentDto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    protected $service;

    /**
     * CommentController constructor.
     * @param CommentServices $service
     */
    public function __construct(CommentServices $service)
    {
        $this->middleware(['auth']);
        $this->service = $service;
    }

    public function commentCreate(Request $request, Posts $post )
    {
        if($this->service->validateComment($request)) {

            $commentDto = new CommentDto($request->get('CommentBody'),Auth::user()->id,$post->id);

            if($this->service->Comment($commentDto)) {

                return redirect()->to(route('client.post.show',$post))->with('success', trans('user.message.successCreateComment'));
            }  else {
                return redirect()->to(route('client.post.show',$post))->with('error', trans('user.message.errorCreateComment'));
            }

        } else {
            return redirect()->to(route('client.post.show',$post))->with('error', trans('user.message.errorValidatePost'));
        }

    }

    public function commentLikeComment(Request $request )
    {
        $comment_id = $request['commentId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $comment = Comments::find($comment_id);
        if (!$comment) {
            return null;
        }
        $user = Auth::user();
        $like = $user->commentsLikes()->where('comment_id', $comment_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == true) {
                $comment->likes = $comment->likes - 1 ;

            }else
            {
                $comment->likes = $comment->likes + 1 ;
            }
            $comment->save();
            if ($already_like == $is_like) {
                $like->delete();
                return response()->json(['success'=>"$comment->likes"]);
            }

        } else {
            $like = new CommentLikes();
            if ($is_like == true)
            {
                $comment->likes = $comment->likes + 1 ;
            }

        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->comment_id = $comment->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        $comment->save();
        return response()->json(['success'=>"$comment->likes"]);
    }
}
