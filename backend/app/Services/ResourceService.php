<?php

namespace App\Services;

use App\Models\PostComment;
use App\Models\ProjectPost;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectRole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ResourceService
{
    private mixed $model;
    private array $parent;

    private function __construct(mixed $model, array $parent = [])
    {
        $this->model = $model;
        $this->parent = $parent;
    }

    public function all(): Collection
    {
        if (empty($this->parent)) {
            return $this->model::all();
        }

        return $this->model::{'where' . $this->parent['Name'] . 'Id'}($this->parent['Id'])->get();
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

    public static function withUsers()
    {
        return new self(User::class);
    }

    public static function withProjects()
    {
        return new self(Project::class);
    }

    public static function withProjectRoles(int $parentId)
    {
        return new self(ProjectRole::class, ['Name' => 'Project', 'Id' => $parentId]);
    }

    public static function withProjectMembers(int $parentId)
    {
        return new self(ProjectMember::class, ['Name' => 'Project', 'Id' => $parentId]);
    }

    public static function withProjectPosts(int $parentId)
    {
        return new self(ProjectPost::class, ['Name' => 'Project', 'Id' => $parentId]);
    }

    public static function withPostsComments(int $parentId)
    {
        return new self(PostComment::class, ['Name' => 'ProjectPost', 'Id' => $parentId]);
    }
}
