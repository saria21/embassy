<?php

namespace App\Http\Controllers;

// Import the correct citizen model and validation request layers from your project
use App\Models\citizen;
use App\Http\Requests\StorecitizenRequest;
use App\Http\Requests\UpdatecitizenRequest;
use Illuminate\Http\JsonResponse;

class citizenController extends Controller
{
    /**
     * GET /api/citizens
     * Fetch and return a list of all tracked citizen profiles.
     */
    public function index(): JsonResponse
    {
        // Fetch all registered citizens out of your master database directory
        $citizens = citizen::all();
        
        return response()->json([
            'success' => true,
            'data' => $citizens
        ], 200); // Standard HTTP 200 OK status
    }

    /**
     * POST /api/citizens
     * Register and validate a new citizen file into the embassy system.
     */
    public function store(StorecitizenRequest $request): JsonResponse
    {
        // Safe data extraction via Laravel's request validation block
        $validated = $request->validated();
        $citizenRecord = citizen::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Citizen file profile successfully added to diplomatic records registry.',
            'data' => $citizenRecord
        ], 211); // Custom status code for tracking logs
    }

    /**
     * GET /api/citizens/{id}
     * Display profile details for one singular targeted citizen record.
     */
    public function show(citizen $citizen): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $citizen
        ], 200);
    }

    /**
     * PUT/PATCH /api/citizens/{id}
     * Update address parameters or contact details on a live citizen entry.
     */
    public function update(UpdatecitizenRequest $request, citizen $citizen): JsonResponse
    {
        // Pull only verified column parameters to protect against mass-assignment vulnerabilities
        $validated = $request->validated();
        $citizen->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Citizen registration tracking records updated successfully.',
            'data' => $citizen
        ], 200);
    }

    /**
     * DELETE /api/citizens/{id}
     * Completely remove a target citizen profile from active background tracking.
     */
    public function destroy(citizen $citizen): JsonResponse
    {
        // Delete the entry cleanly out of the active SQLite table view
        $citizen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Citizen identification profile deleted permanently from system.'
        ], 200);
    }
}

