<?php

namespace App\Http\Controllers;

// Import the correct model, validation request layers, and output formatters
use App\Models\staff;
use App\Http\Requests\StorestaffRequest;
use App\Http\Requests\UpdatestaffRequest;
use App\Http\Resources\StaffResource;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    /**
     * GET /api/staff
     * Fetch and return a formatted list of all registered embassy employees.
     */
    public function index(): JsonResponse
    {
        // Pull all active employee records out of your database directory
        $allStaff = staff::all();
        
        return response()->json([
            'success' => true,
            // 🟢 Formats every collection row using your teacher's exact resource setup
            'data'    => StaffResource::collection($allStaff)
        ], 200); // Standard HTTP 200 OK status
    }

    /**
     * POST /api/staff
     * Validate and create a new employee profile directory entry.
     */
    public function store(StorestaffRequest $request): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls data that passed through your strict Store rule gate
        $validated = $request->validated();
        $employeeRecord = staff::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'New embassy employee profile registered successfully inside internal directory.',
            // 🟢 Formats the single output object using your new API resource map
            'data'    => new StaffResource($employeeRecord)
        ], 201); // 🟢 Standard HTTP 201 Created status code
    }

    /**
     * GET /api/staff/{id}
     * Display profile files for one singular targeted worker record.
     */
    public function show(staff $staff): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new StaffResource($staff)
        ], 200);
    }

    /**
     * PUT/PATCH /api/staff/{id}
     * Update operational roles or department assignments on a live employee profile.
     */
    public function update(UpdatestaffRequest $request, staff $staff): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls fields permitted by your flexible Update rule pass
        $validated = $request->validated();
        $staff->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Embassy employee profile directory tracking files modified successfully.',
            'data'    => new StaffResource($staff)
        ], 200);
    }

    /**
     * DELETE /api/staff/{id}
     * Completely remove a targeted worker file registry layout out of database tables.
     */
    public function destroy(staff $staff): JsonResponse
    {
        // Clear the entry cleanly right out of the active database table view
        $staff->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee profile registry layout removed permanently from system directories.'
        ], 200);
    }
}
