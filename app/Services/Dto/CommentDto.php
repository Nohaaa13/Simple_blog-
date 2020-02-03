<?php
namespace App\Services\Dto;


class CommentDto
{

    private $body;
    private $user_id;
    private $post_id;

    /**
     * CommentDto constructor.
     * @param string $body
     * @param int $user_id
     * @param int $post_id
     */
    public function __construct( string $body, int $user_id, int $post_id)
    {
        $this->body = $body;
        $this->user_id = $user_id;
        $this->post_id = $post_id;
    }

    /**
     * @return string
     */
    public function getCommentBody(): string
    {
        return $this->body;
    }
    /**
     * @return int
     */
    public function getCommentUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return int
     */
    public function getCommentPostId(): int
    {
        return $this->post_id;
    }


}
