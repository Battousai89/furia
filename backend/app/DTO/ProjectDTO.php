<?php

namespace App\DTO;

use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class ProjectDTO extends DataTransferObject
{
    public string $name;

    #[MapFrom('user_id')]
    #[MapTo('user_id')]
    public ?int $userId;

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
