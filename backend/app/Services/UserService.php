<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class UserService implements IResourceService
{
    public function all(): Collection
    {
        return User::all();
    }

    public function getById(int $id): ?Model
    {
        return User::whereId($id)->first();
    }

    public function create($DTO): Model|Collection
    {
        return User::factory()->create($DTO->toArray());
    }

    public function update($DTO, int $id): int
    {
        $user = User::whereId($id)->first();
        return $user->update($DTO->toArray());
    }

    public function delete(int $id): ?bool
    {
        return User::whereId($id)->first()->delete();
    }
}
