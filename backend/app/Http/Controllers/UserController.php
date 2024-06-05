<?php

namespace App\Http\Controllers;

use App\DTO\UserFields;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userService->getAll();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userFields = new UserFields($request->toArray());
        return $this->userService->create($userFields);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->userService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userFields = new UserFields($request->toArray());
        return $this->userService->update($userFields, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->userService->delete($id);
    }
}
