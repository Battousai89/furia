<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class ChatMessageDTO extends DataTransferObject
{
    #[MapFrom('chat_id')]
    #[MapTo('chat_id')]
    public int $chatId;

    #[MapFrom('chat_member_id')]
    #[MapTo('chat_member_id')]
    public ?int $chatMemberId;

    public string $content;

    public ?string $files;
}
