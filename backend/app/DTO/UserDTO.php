<?php

namespace App\DTO;

use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public string $name;

    public string $email;

    #[MapFrom('email_verified_at')]
    #[MapTo('email_verified_at')]
    public ?Carbon $emailVerifiedAt;

    public string $password;

    #[MapFrom('remember_token')]
    #[MapTo('remember_token')]
    public string $rememberToken;
}
