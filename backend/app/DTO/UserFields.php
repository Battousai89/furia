<?php

namespace App\DTO;

use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\DataTransferObject;
class UserFields extends DataTransferObject
{
    public string $name;
    public string $email;
    public ?Carbon $email_verified_at;
    public string $password;
    public string $remember_token;
}
