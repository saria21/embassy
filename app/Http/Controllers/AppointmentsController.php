<?php

namespace App\Http\Controllers;

// Import the correct model, validation requests, and response resources
use App\Models\appointments;
use App\Http\Requests\StoreappointmentsRequest;
use App\Http\Requests\UpdateappointmentsRequest;
use App\Http\Resources\AppointmentResource;
use Illuminate\Http\JsonResponse;

class AppointmentsController extends Controller
{
    /**
     * GET /api/appointments
     * Fetch and return a formatted list of all booked embassy appointments.
     */
    public function index(): JsonResponse
    {
        // Pull all appointments out of your master database directory
        $bookings = appointments::all();
        
        return response()->json([
            'success' => true,
            // 🟢 Formats every single collection item using your teacher's resource layout
            'data'    => AppointmentResource::collection($bookings)
        ], 200);
    }

    /**
     * POST /api/appointments
     * Validate and create a new embassy visitation slot entry.
     */
    public function store(StoreappointmentsRequest $request): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls data that passed through your strict Store rule gate
        $validated = $request->validated();
        $booking = appointments::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Embassy appointment booked successfully inside the scheduling calendar.',
            // 🟢 Formats the single output object using your new API resource map
            'data'    => new AppointmentResource($booking)
        ], 211);
    }

    /**
     * GET /api/appointments/{id}
     * Display profile details for one singular targeted visitation record.
     */
    public function show(appointments $appointments): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new AppointmentResource($appointments)
        ], 200);
    }

    /**
     * PUT/PATCH /api/appointments/{id}
     * Update scheduling configurations on a live appointment entry.
     */
    public function update(UpdateappointmentsRequest $request, appointments $appointments): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls fields permitted by your flexible Update rule pass
        $validated = $request->validated();
        $appointments->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Appointment details modified successfully in system schedule.',
            'data'    => new AppointmentResource($appointments)
        ], 200);
    }

    /**
     * DELETE /api/appointments/{id}
     * Completely remove a target appointment out of active scheduling calendars.
     */
    public function destroy(appointments $appointments): JsonResponse
    {
        // Clear the entry cleanly right out of the active SQLite table view
        $appointments->delete();

        return response()->json([
            'success' => true,
            'message' => 'Embassy appointment reservation removed permanently from system.'
        ], 200);
    }
}
