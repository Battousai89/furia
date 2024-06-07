<?php

use App\Http\Controllers\ApiResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Users Routes
Route::prefix('users')->group(function () {
    Route::get('', function () {
        return ApiResourceController::withUsers()->list();
    });
    Route::post('', function (Request $request) {
        return ApiResourceController::withUsers()->add($request);
    });
    Route::get('{id}', function (string $id) {
        return ApiResourceController::withUsers()->show((int)$id);
    });
    Route::put('{id}', function (Request $request, string $id) {
        return ApiResourceController::withUsers()->update($request, (int)$id);
    });
    Route::patch('{id}', function (Request $request, string $id) {
        return ApiResourceController::withUsers()->update($request, (int)$id);
    });
    Route::delete('{id}', function (string $id) {
        return ApiResourceController::withUsers()->destroy((int)$id);
    });
});


//Projects Routes
Route::prefix('projects')->group(function () {
    Route::get('', function () {
        return ApiResourceController::withProjects()->list();
    });
    Route::post('', function (Request $request) {
        return ApiResourceController::withProjects()->add($request);
    });
    Route::get('{id}', function (string $id) {
        return ApiResourceController::withProjects()->show((int)$id);
    });
    Route::put('{id}', function (Request $request, string $id) {
        return ApiResourceController::withProjects()->update($request, (int)$id);
    });
    Route::patch('{id}', function (Request $request, string $id) {
        return ApiResourceController::withProjects()->update($request, (int)$id);
    });
    Route::delete('{id}', function (string $id) {
        return ApiResourceController::withProjects()->destroy((int)$id);
    });

    //Project Roles Routes
    Route::prefix('{projectId}/roles')->group(function () {
        Route::get('', function (string $projectId) {
            return ApiResourceController::withProjectRoles($projectId)->list();
        });
        Route::post('', function (string $projectId, Request $request) {
            return ApiResourceController::withProjectRoles($projectId)->add($request);
        });
        Route::get('{roleId}', function (string $projectId, string $roleId) {
            return ApiResourceController::withProjectRoles($projectId)->show((int)$roleId);
        });
        Route::put('{roleId}', function (Request $request, string $projectId, string $roleId) {
            return ApiResourceController::withProjectRoles($projectId)->update($request, (int)$roleId);
        });
        Route::patch('{roleId}', function (Request $request, string $projectId, string $roleId) {
            return ApiResourceController::withProjectRoles($projectId)->update($request, (int)$roleId);
        });
        Route::delete('{roleId}', function (string $projectId, string $roleId) {
            return ApiResourceController::withProjectRoles($projectId)->destroy((int)$roleId);
        });
    });

    //Project Members Routes
    Route::prefix('{projectId}/members')->group(function () {
        Route::get('', function (string $projectId) {
            return ApiResourceController::withProjectMembers($projectId)->list();
        });
        Route::post('', function (string $projectId, Request $request) {
            return ApiResourceController::withProjectMembers($projectId)->add($request);
        });
        Route::get('{memberId}', function (string $projectId, string $memberId) {
            return ApiResourceController::withProjectMembers($projectId)->show((int)$memberId);
        });
        Route::put('{memberId}', function (Request $request, string $projectId, string $memberId) {
            return ApiResourceController::withProjectMembers($projectId)->update($request, (int)$memberId);
        });
        Route::patch('{memberId}', function (Request $request, string $projectId, string $memberId) {
            return ApiResourceController::withProjectMembers($projectId)->update($request, (int)$memberId);
        });
        Route::delete('{memberId}', function (string $projectId, string $memberId) {
            return ApiResourceController::withProjectMembers($projectId)->destroy((int)$memberId);
        });
    });

    //Project Posts Routes
    Route::prefix('{projectId}/posts')->group(function () {
        Route::get('', function (string $projectId) {
            return ApiResourceController::withProjectPosts((int)$projectId)->list();
        });
        Route::post('', function (string $projectId, Request $request) {
            return ApiResourceController::withProjectPosts((int)$projectId)->add($request);
        });
        Route::get('{postId}', function (string $projectId, string $postId) {
            return ApiResourceController::withProjectPosts((int)$projectId)->show((int)$postId);
        });
        Route::put('{postId}', function (Request $request, string $projectId, string $postId) {
            return ApiResourceController::withProjectPosts((int)$projectId)->update($request, (int)$postId);
        });
        Route::patch('{postId}', function (Request $request, string $projectId, string $postId) {
            return ApiResourceController::withProjectPosts((int)$projectId)->update($request, (int)$postId);
        });
        Route::delete('{postId}', function (string $projectId, string $postId) {
            return ApiResourceController::withProjectPosts((int)$projectId)->destroy((int)$postId);
        });

        //Post Comments Routes
        Route::prefix('{postId}/comments')->group(function () {
            Route::get('', function (string $projectId, string $postId) {
                return ApiResourceController::withPostsComments((int)$postId)->list();
            });
            Route::post('', function (string $projectId, string $postId, Request $request) {
                return ApiResourceController::withPostsComments((int)$postId)->add($request);
            });
            Route::get('{commentId}', function (string $projectId, string $postId, string $commentId) {
                return ApiResourceController::withPostsComments((int)$postId)->show((int)$commentId);
            });
            Route::put('{commentId}', function (Request $request, string $projectId, string $postId, string $commentId) {
                return ApiResourceController::withPostsComments((int)$postId)->update($request, (int)$commentId);
            });
            Route::patch('{commentId}', function (Request $request, string $projectId, string $postId, string $commentId) {
                return ApiResourceController::withPostsComments((int)$postId)->update($request, (int)$commentId);
            });
            Route::delete('{commentId}', function (string $projectId, string $postId, string $commentId) {
                return ApiResourceController::withPostsComments((int)$postId)->destroy((int)$commentId);
            });
        });
    });
});



