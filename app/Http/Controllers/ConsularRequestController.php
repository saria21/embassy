<?php

namespace App\Http\Controllers;

// 🟢 FIX: Imported the correct singular model matching your sidebar definition
use App\Models\consular_request;
use App\Http\Requests\Storeconsular_requestsRequest;
use App\Http\Requests\Updateconsular_requestsRequest;
use App\Http\Resources\ConsularRequestResource;
use Illuminate\Http\JsonResponse;

class ConsularRequestController extends Controller
{
    /**
     * GET /api/consular-requests
     * Fetch and return a formatted list of all registered consular paperwork entries.
     */
    public function index(): JsonResponse
    {
        // 🟢 FIX: Uses the true singular model class definition
        $requests = consular_request::all();
        
        return response()->json([
            'success' => true,
            'data'    => ConsularRequestResource::collection($requests)
        ], 200); 
    }

    /**
     * POST /api/consular-requests
     * Validate and create a new consular processing file entry.
     */
    public function store(Storeconsular_requestsRequest $request): JsonResponse
    {
        $validated = $request->validated();
        
        // 🟢 FIX: Uses the true singular model class definition
        $consularRecord = consular_request::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Consular paperwork tracking file registered successfully into system directory.',
            'data'    => new ConsularRequestResource($consularRecord)
        ], 201); 
    }

    /**
     * GET /api/consular-requests/{id}
     * Display tracking details for one singular targeted paperwork record.
     */
    public function show(consular_request $consular_request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new ConsularRequestResource($consular_request)
        ], 200);
    }

    /**
     * PUT/PATCH /api/consular-requests/{id}
     * Update processing milestones or request categories on a live consular entry.
     */
    public function update(Updateconsular_requestsRequest $request, consular_request $consular_request): JsonResponse
    {
        $validated = $request->validated();
        $consular_request->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Consular application processing metrics modified successfully.',
            'data'    => new ConsularRequestResource($consular_request)
        ], 200);
    }

    /**
     * DELETE /api/consular-requests/{id}
     * Completely remove a targeted paperwork record from background tracking.
     */
    public function destroy(consular_request $consular_request): JsonResponse
    {
        $consular_request->delete();

        return response()->json([
            'success' => true,
            'message' => 'Consular processing tracking file removed permanently from records.'
        ], 200);
    }
}
