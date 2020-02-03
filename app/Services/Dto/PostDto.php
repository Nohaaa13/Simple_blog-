<?php
namespace App\Services\Dto;


class PostDto
{

    private $title;
    private $body;
    private $user_id;

    /**
     * PostDto constructor.
     * @param string $title
     * @param string $body
     * @param int $user_id
     */
    public function __construct(string $title, string $body, int $user_id)
    {
        $this->title = $title;
        $this->body = $body;
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getPostTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getPostBody(): string
    {
        return $this->body;
    }
    /**
     * @return int
     */
    public function getPostUserId(): int
    {
        return $this->user_id;
    }


}
