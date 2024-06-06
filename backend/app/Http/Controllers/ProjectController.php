<?php

namespace App\Http\Controllers;

use App\DTO\ProjectDTO;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projectService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->projectService->all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $projectDTO = new ProjectDTO($request->toArray());
        return $this->projectService->create($projectDTO);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->projectService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $projectDTO = new ProjectDTO($request->toArray());
        return $this->projectService->update($projectDTO, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->projectService->delete($id);
    }
}
