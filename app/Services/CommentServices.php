<?php
namespace App\Services;


use App\Entity\Comments;
use App\Entity\Posts;
use App\Http\Requests\CommentRequest;
use App\Services\Dto\CommentDto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CommentServices
{


    /**
     * @param Request $request
     * @return bool
     * @description validate Comment
     */
    public function validateComment(Request $request)
    {
        $valid = Validator::make($request->all(), CommentRequest::rulesOne());
        if ($valid->fails()) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * @param CommentDto $commentDto
     * @return Comments|bool
     * @description Comment
     */
    public function Comment($commentDto)
    {
        try {
            $comment = new Comments();
            $comment->users()->associate($commentDto->getCommentUserId());
            $comment->posts()->associate($commentDto->getCommentPostId());
            $comment->body = $commentDto->getCommentBody();
            $comment->timestamps = Carbon::now();
            $comment->save();

            return $comment;

        } catch (\Exception $exception) {
            return false;
        }
    }


}
