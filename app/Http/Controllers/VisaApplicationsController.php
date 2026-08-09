<?php
namespace App\Http\Controllers;

use App\Models\visa_applications;
use App\Http\Requests\Storevisa_applicationsRequest;
use App\Http\Requests\Updatevisa_applicationsRequest;
use Illuminate\Http\JsonResponse;

class VisaApplicationsController extends Controller
{
    /**
     * GET /api/visa-applications
     * Fetch and return a list of all active visa application entries.
     */
    public function index(): JsonResponse
    {
        // Eager load the 'applicant' relation to prevent N+1 database queries
        $applications = visa_applications::with('applicant')->get();
        
        return response()->json([
            'success' => true,
            'data' => $applications
        ], 200); // Standard HTTP 200 OK status
    }

    /**
     * POST /api/visa-applications
     * Process and validate an incoming new visa registration file.
     */
    public function store(Storevisa_applicationsRequest $request): JsonResponse
    {
        // Safe data extraction via Laravel's request validation block
        $validated = $request->validated();
        $application = visa_applications::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Visa application registered successfully into diplomatic queue.',
            'data' => $application
        ], 211); // Custom status code for tracking tracking logs
    }

    /**
     * GET /api/visa-applications/{id}
     * Display structural file details for one singular targeted visa request.
     */
    public function show(visa_applications $visa_applications): JsonResponse
    {
        // Dynamically load the associated visa applicant profile side-by-side
        $visa_applications->load('applicant');

        return response()->json([
            'success' => true,
            'data' => $visa_applications
        ], 200);
    }

    /**
     * PUT/PATCH /api/visa-applications/{id}
     * Update processing metrics (like status shifts) on a live application record.
     */
    public function update(Updatevisa_applicationsRequest $request, visa_applications $visa_applications): JsonResponse
    {
        // Pull only verified column parameters to protect against mass-assignment vulnerabilities
        $validated = $request->validated();
        $visa_applications->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Visa file metrics updated successfully in system directory.',
            'data' => $visa_applications
        ], 200);
    }

    /**
     * DELETE /api/visa-applications/{id}
     * Completely remove a target file out of active background tracking loops.
     */
    public function destroy(visa_applications $visa_applications): JsonResponse
    {
        // Delete the entry cleanly out of the active SQLite table view
        $visa_applications->delete();

        return response()->json([
            'success' => true,
            'message' => 'Visa application tracking file deleted permanently from records.'
        ], 200);
    }
}
