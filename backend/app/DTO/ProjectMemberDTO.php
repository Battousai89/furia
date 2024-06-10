<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class ProjectMemberDTO extends DataTransferObject
{
    #[MapFrom('user_id')]
    #[MapTo('user_id')]
    public int $userId;

    #[MapFrom('project_role_id')]
    #[MapTo('project_role_id')]
    public ?int $projectRolId;

}
