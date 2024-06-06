<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectService implements IResourceService
{
    public function all(): Collection
    {
        return Project::all();
    }

    public function getById($id): ?Model
    {
        return Project::whereId($id)->first();
    }

    public function create($DTO): Model|Collection
    {
        return Project::factory()->create($DTO->toArray());
    }

    public function update($DTO, int $id): int
    {
        $user = Project::whereId($id)->first();
        return $user->update($DTO->toArray());
    }

    public function delete(int $id): ?bool
    {
        return Project::whereId($id)->first()->delete();
    }
}
