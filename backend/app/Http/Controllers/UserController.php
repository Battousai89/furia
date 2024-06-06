<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
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
        return $this->userService->all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userDTO = new UserDTO($request->toArray());
        return $this->userService->create($userDTO);
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
        $userDTO = new UserDTO($request->toArray());
        return $this->userService->update($userDTO, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->userService->delete($id);
    }
}
