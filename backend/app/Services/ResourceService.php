<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ResourceService
{
    private mixed $model;

    public function __construct(mixed $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model::all();
    }

    public function getById($id): ?Model
    {
        return $this->model::whereId($id)->first();
    }

    public function create($DTO): Model|Collection
    {
        return $this->model::factory()->create($DTO->toArray());
    }

    public function update($DTO, int $id): int
    {
        $user = $this->model::whereId($id)->first();
        return $user->update($DTO->toArray());
    }

    public function delete(int $id): ?bool
    {
        return $this->model::whereId($id)->first()->delete();
    }
}
