<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class ChatDTO extends DataTransferObject
{
    public string $title;

    #[MapFrom('project_id')]
    #[MapTo('project_id')]
    public ?int $projectId;

    public ?string $description;

    public ?string $picture;
}
