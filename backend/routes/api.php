<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ChatMemberController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\ProjectPostController;
use App\Http\Controllers\ProjectRoleController;
use App\Http\Controllers\ProjectMemberController;

Route::apiResources([
    'users' => UserController::class,
    'projects' => ProjectController::class,
    'projects.roles' => ProjectRoleController::class,
    'projects.members' => ProjectMemberController::class,
    'project.posts' => ProjectPostController::class,
    'project.posts.comments' => PostCommentController::class,
    'chats' => ChatController::class,
    'chats.members' => ChatMemberController::class,
    'chats.messages' => ChatMessageController::class,
]);
