<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class ProjectRoleDTO extends DataTransferObject
{
    #[MapFrom('project_id')]
    #[MapTo('project_id')]
    public ?int $projectId;

    public string $name;

    #[MapFrom('is_can_create_posts')]
    #[MapTo('is_can_create_posts')]
    public bool $isCanCreatePosts = false;

    #[MapFrom('is_can_edit_posts')]
    #[MapTo('is_can_edit_posts')]
    public bool $isCanEditPosts = false;

    #[MapFrom('is_can_remove_posts')]
    #[MapTo('is_can_remove_posts')]
    public bool $isCanRemovePosts = false;

    #[MapFrom('is_can_create_chats')]
    #[MapTo('is_can_create_chats')]
    public bool $isCanCreateChats = false;

    #[MapFrom('is_can_invite_members')]
    #[MapTo('is_can_invite_members')]
    public bool $isCanInviteMembers = false;

    #[MapFrom('is_can_accept_members')]
    #[MapTo('is_can_accept_members')]
    public bool $isCanAcceptMembers = false;

    #[MapFrom('is_can_remove_members')]
    #[MapTo('is_can_remove_members')]
    public bool $isCanRemoveMembers = false;

    #[MapFrom('is_can_change_project_name')]
    #[MapTo('is_can_change_project_name')]
    public bool $isCanChangeProjectName = false;

    #[MapFrom('is_can_change_project_preview')]
    #[MapTo('is_can_change_project_preview')]
    public bool $isCanChangeProjectPreview = false;

    #[MapFrom('is_can_change_project_description')]
    #[MapTo('is_can_change_project_description')]
    public bool $isCanChangeProjectDescription = false;

    #[MapFrom('is_can_change_project_preview_picture')]
    #[MapTo('is_can_change_project_preview_picture')]
    public bool $isCanChangeProjectPreviewPicture = false;

    #[MapFrom('is_can_change_project_detail_picture')]
    #[MapTo('is_can_change_project_detail_picture')]
    public bool $isCanChangeProjectDetailPicture = false;
}
