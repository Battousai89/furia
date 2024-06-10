<?php

namespace App\Http\Controllers;

use App\DTO\ChatDTO;
use App\Models\Chat;
use App\Models\User;
use App\DTO\UserDTO;
use App\Models\Project;
use App\DTO\ProjectDTO;
use App\Models\ChatMember;
use App\DTO\ChatMemberDTO;
use App\DTO\ChatMessageDTO;
use App\DTO\ProjectPostDTO;
use App\DTO\ProjectRoleDTO;
use App\Models\ChatMessage;
use App\Models\ProjectPost;
use App\Models\PostComment;
use App\DTO\PostCommentDTO;
use App\Models\ProjectRole;
use Illuminate\Http\Request;
use App\Models\ProjectMember;
use App\DTO\ProjectMemberDTO;
use App\Services\ResourceService;
use Illuminate\Support\Facades\Route;

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
        return new self(new ResourceService(User::class), UserDTO::class);
    }

    public static function withProjects()
    {
        return new self(new ResourceService(Project::class), ProjectDTO::class);
    }

    public static function withProjectRoles()
    {
        return new self(new ResourceService(ProjectRole::class), ProjectRoleDTO::class);
    }

    public static function withProjectMembers()
    {
        return new self(new ResourceService(ProjectMember::class), ProjectMemberDTO::class);
    }

    public static function withProjectPosts()
    {
        return new self(new ResourceService(ProjectPost::class), ProjectPostDTO::class);
    }

    public static function withPostsComments()
    {
        return new self(new ResourceService(PostComment::class), PostCommentDTO::class);
    }

    public static function withChats()
    {
        return new self(new ResourceService(Chat::class), ChatDTO::class);
    }

    public static function withChatMembers()
    {
        return new self(new ResourceService(ChatMember::class), ChatMemberDTO::class);
    }

    public static function withChatMessages()
    {
        return new self(new ResourceService(ChatMessage::class), ChatMessageDTO::class);
    }

    public static function getCrudRoutes(self $controller)
    {
        Route::get('', function () use ($controller) {
            return $controller->list();
        });
        Route::post('', function (Request $request) use ($controller) {
            return $controller->add($request);
        });
        Route::get('{id}', function (string $id) use ($controller) {
            return $controller->show((int)$id);
        });
        Route::put('{id}', function (Request $request, string $id) use ($controller) {
            return $controller->update($request, (int)$id);
        });
        Route::patch('{id}', function (Request $request, string $id) use ($controller) {
            return $controller->update($request, (int)$id);
        });
        Route::delete('{id}', function (string $id) use ($controller) {
            return $controller->destroy((int)$id);
        });
    }
}
