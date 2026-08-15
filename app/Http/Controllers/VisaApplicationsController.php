<?php

namespace App\Http\Controllers;

// Import the correct model, validation requests, and response resources
use App\Models\visa_applications;
use App\Http\Requests\Storevisa_applicationsRequest;
use App\Http\Requests\Updatevisa_applicationsRequest;
use App\Http\Resources\VisaApplicationResource;
use Illuminate\Http\JsonResponse;

class VisaApplicationsController extends Controller
{
    /**
     * GET /api/visa-applications
     * Fetch and return a formatted list of all active visa application entries.
     */
    public function index(): JsonResponse
    {
        // Pull all applications out of your master database directory
        $applications = visa_applications::all();
        
        return response()->json([
            'success' => true,
            // 🟢 Formats every single collection item using your teacher's resource layout
            'data'    => VisaApplicationResource::collection($applications)
        ], 200); // Standard HTTP 200 OK status
    }

    /**
     * POST /api/visa-applications
     * Process and validate an incoming new visa registration file.
     */
    public function store(Storevisa_applicationsRequest $request): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls data that passed through your strict Store rule gate
        $validated = $request->validated();
        $application = visa_applications::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Visa application registered successfully into diplomatic queue.',
            // 🟢 Formats the single output object using your new API resource map
            'data'    => new VisaApplicationResource($application)
        ], 201); // Custom status code for tracking tracking logs
    }

    /**
     * GET /api/visa-applications/{id}
     * Display structural file details for one singular targeted visa request.
     */
    public function show(visa_applications $visa_applications): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new VisaApplicationResource($visa_applications)
        ], 200);
    }

    /**
     * PUT/PATCH /api/visa-applications/{id}
     * Update processing metrics (like status shifts) on a live application record.
     */
    public function update(Updatevisa_applicationsRequest $request, visa_applications $visa_applications): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls fields permitted by your flexible Update rule pass
        $validated = $request->validated();
        $visa_applications->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Visa file metrics updated successfully in system directory.',
            'data'    => new VisaApplicationResource($visa_applications)
        ], 200);
    }

    /**
     * DELETE /api/visa-applications/{id}
     * Completely remove a target file out of active background tracking loops.
     */
    public function destroy(visa_applications $visa_applications): JsonResponse
    {
        // Clear the entry cleanly right out of the active SQLite table view
        $visa_applications->delete();

        return response()->json([
            'success' => true,
            'message' => 'Visa application tracking file deleted permanently from records.'
        ], 200);
    }
}
