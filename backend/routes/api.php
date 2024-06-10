<?php

use App\Http\Controllers\ApiResourceController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    ApiResourceController::getCrudRoutes(controller: ApiResourceController::withUsers());
});

Route::prefix('chats')->group(function () {
    Route::prefix('members')->group(function () {
        ApiResourceController::getCrudRoutes(controller: ApiResourceController::withChatMembers());
    });
    Route::prefix('messages')->group(function () {
        ApiResourceController::getCrudRoutes(controller: ApiResourceController::withChatMessages());
    });
    ApiResourceController::getCrudRoutes(controller: ApiResourceController::withChats());
});

Route::prefix('projects')->group(function () {
    Route::prefix('members')->group(function () {
        ApiResourceController::getCrudRoutes(controller: ApiResourceController::withProjectMembers());
    });
    Route::prefix('roles')->group(function () {
        ApiResourceController::getCrudRoutes(controller: ApiResourceController::withProjectRoles());
    });
    Route::prefix('posts')->group(function () {
        Route::prefix('comments')->group(function () {
            ApiResourceController::getCrudRoutes(controller: ApiResourceController::withPostsComments());
        });
        ApiResourceController::getCrudRoutes(controller: ApiResourceController::withProjectPosts());
    });
    ApiResourceController::getCrudRoutes(controller: ApiResourceController::withProjects());
});


