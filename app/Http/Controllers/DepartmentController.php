<?php

namespace App\Http\Controllers;

// Import the correct model, validation request layers, and output formatters
use App\Models\department;
use App\Http\Requests\StoredepartmentRequest;
use App\Http\Requests\UpdatedepartmentRequest;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
    /**
     * GET /api/departments
     * Fetch and return a formatted list of all structural embassy sectors.
     */
    public function index(): JsonResponse
    {
        // Pull all active department records out of your database directory
        $departments = department::all();
        
        return response()->json([
            'success' => true,
            // 🟢 Formats every collection row using your teacher's exact resource setup
            'data'    => DepartmentResource::collection($departments)
        ], 200); // Standard HTTP 200 OK status
    }

    /**
     * POST /api/departments
     * Validate and create a new structural department division configuration.
     */
    public function store(StoredepartmentRequest $request): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls data that passed through your strict Store rule gate
        $validated = $request->validated();
        $departmentRecord = department::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Embassy department division registered successfully inside system settings.',
            // 🟢 Formats the single output object using your new API resource map
            'data'    => new DepartmentResource($departmentRecord)
        ], 201); // 🟢 Standard HTTP 201 Created status code
    }

    /**
     * GET /api/departments/{id}
     * Display details for one singular targeted department division entry.
     */
    public function show(department $department): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new DepartmentResource($department)
        ], 200);
    }

    /**
     * PUT/PATCH /api/departments/{id}
     * Update structural titles or building links on a live department entry.
     */
    public function update(UpdatedepartmentRequest $request, department $department): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls fields permitted by your flexible Update rule pass
        $validated = $request->validated();
        $department->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Department infrastructure metrics modified successfully.',
            'data'    => new DepartmentResource($department)
        ], 200);
    }

    /**
     * DELETE /api/departments/{id}
     * Completely remove a targeted structural sector out of system tracking loops.
     */
    public function destroy(department $department): JsonResponse
    {
        // Clear the entry cleanly right out of the active database table view
        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Department division profile removed permanently from system directory.'
        ], 200);
    }
}

