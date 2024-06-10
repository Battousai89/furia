<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class ChatMemberDTO extends DataTransferObject
{
    #[MapFrom('chat_id')]
    #[MapTo('chat_id')]
    public int $chatId;

    #[MapFrom('user_id')]
    #[MapTo('user_id')]
    public int $userId;

    #[MapFrom('is_owner')]
    #[MapTo('is_owner')]
    public bool $isOwner;

    #[MapFrom('is_can_write')]
    #[MapTo('is_can_write')]
    public bool $isCanWrite;

    #[MapFrom('is_can_send_react')]
    #[MapTo('is_can_send_react')]
    public bool $isCanSendReact;

    #[MapFrom('is_can_send_audio')]
    #[MapTo('is_can_send_audio')]
    public bool $isCanSendAudio;

    #[MapFrom('is_can_send_video')]
    #[MapTo('is_can_send_video')]
    public bool $isCanSendVideo;

    #[MapFrom('is_can_send_files')]
    #[MapTo('is_can_send_files')]
    public bool $isCanSendFiles;

    #[MapFrom('is_can_invite_members')]
    #[MapTo('is_can_invite_members')]
    public bool $isCanInviteMembers;

    #[MapFrom('is_can_accept_members')]
    #[MapTo('is_can_accept_members')]
    public bool $isCanAcceptMembers;

    #[MapFrom('is_can_remove_members')]
    #[MapTo('is_can_remove_members')]
    public bool $isCanRemoveMembers;
}
