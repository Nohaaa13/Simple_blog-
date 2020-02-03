<?php
namespace App\Services;


use App\Entity\Posts;
use App\Entity\User\User;
use App\Http\Requests\PostRequest;
use App\Services\Dto\PostDto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PostServices
{


    /**
     * @param Request $request
     * @return bool
     * @description validate Post
     */
    public function validatePost(Request $request)
    {
        $valid = Validator::make($request->all(), PostRequest::rulesOne());
        if ($valid->fails()) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * @param PostDto $postDto
     * @return Posts|bool
     * @description post
     */
    public function Post($postDto)
    {
        try {
            $post = new Posts();
            $post->users()->associate($postDto->getPostUserId());
            $post->title = $postDto->getPostTitle();
            $post->body = $postDto->getPostBody();
            $post->timestamps = Carbon::now();
            $post->save();

            return $post;

        } catch (\Exception $exception) {
            return false;
        }
    }


}
