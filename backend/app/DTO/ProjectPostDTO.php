<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class ProjectPostDTO extends DataTransferObject
{
    #[MapFrom('project_id')]
    #[MapTo('project_id')]
    public int $projectId;

    #[MapFrom('user_id')]
    #[MapTo('user_id')]
    public ?int $userId;

    public string $title;

    #[MapFrom('preview_text')]
    #[MapTo('preview_text')]
    public string $previewText;

    public string $description;

    #[MapFrom('preview_picture')]
    #[MapTo('preview_picture')]
    public ?string $previewPicture;

    #[MapFrom('detail_picture')]
    #[MapTo('detail_picture')]
    public ?string $detailPicture;
}
