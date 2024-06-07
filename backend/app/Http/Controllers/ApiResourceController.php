<?php

namespace App\Http\Controllers;

use App\DTO\PostCommentDTO;
use App\DTO\ProjectDTO;
use App\DTO\ProjectMemberDTO;
use App\DTO\ProjectPostDTO;
use App\DTO\ProjectRoleDTO;
use App\DTO\UserDTO;
use App\Services\ResourceService;
use Illuminate\Http\Request;

class ApiResourceController extends Controller
{
    private ResourceService $service;
    private mixed $DTO;

    private function __construct(
        ResourceService $service,
        mixed $DTO
    ) {
        $this->service = $service;
        $this->DTO = $DTO;
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        return $this->service->all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        $DTO = new $this->DTO($request->toArray());
        return $this->service->create($DTO);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $DTO = new $this->DTO($request->toArray());
        return $this->service->update($DTO, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->service->delete($id);
    }

    public static function withUsers()
    {
        return new self(ResourceService::{__FUNCTION__}(), UserDTO::class);
    }

    public static function withProjects()
    {
        return new self(ResourceService::{__FUNCTION__}(), ProjectDTO::class);
    }

    public static function withProjectRoles(int $parentId)
    {
        return new self(ResourceService::{__FUNCTION__}($parentId), ProjectRoleDTO::class);
    }

    public static function withProjectMembers(int $parentId)
    {
        return new self(ResourceService::{__FUNCTION__}($parentId), ProjectMemberDTO::class);
    }

    public static function withProjectPosts(int $parentId)
    {
        return new self(ResourceService::{__FUNCTION__}($parentId), ProjectPostDTO::class);
    }

    public static function withPostsComments(int $parentId)
    {
        return new self(ResourceService::{__FUNCTION__}($parentId), PostCommentDTO::class);
    }
}
