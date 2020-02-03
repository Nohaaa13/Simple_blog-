<?php

namespace App\Http\Controllers\Client;

use App\Entity\CommentLikes;
use App\Entity\Comments;
use App\Entity\Posts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentCreate(Request $request, Posts $post )
    {
        try {
            $comment = new Comments();
            $comment->body = $request->get('CommentBody');
            $comment->post_id = $post->id;
            $comment->user_id = Auth::user()->id;
            $comment->save();
            return redirect()->to(route('client.post.show',$post))->with('success', trans('user.message.successCreateComment'));
        } catch (\Exception $exception) {
            return redirect()->to(route('client.post.show',$post))->with('error', trans('user.message.errorCreateComment'));
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
