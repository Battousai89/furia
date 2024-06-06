<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Spatie\DataTransferObject\DataTransferObject;

interface IResourceService
{
    public function all(): Collection;

    public function getById(int $id): ?Model;

    public function create(DataTransferObject $DTO): Model|Collection;

    public function update(DataTransferObject $DTO, int $id): int;

    public function delete(int $id): ?bool;
}
