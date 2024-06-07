<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class PostCommentDTO extends DataTransferObject
{
    #[MapFrom('project_post_id')]
    #[MapTo('project_post_id')]
    public int $postId;

    #[MapFrom('user_id')]
    #[MapTo('user_id')]
    public int $userId;


    public string $content;

    #[MapFrom('post_comment_id')]
    #[MapTo('post_comment_id')]
    public ?int $postCommentId;
}
