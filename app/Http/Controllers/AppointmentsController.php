<?php

namespace App\Http\Controllers;

// Import the correct appointments model and validation request layers from your project
use App\Models\appointments;
use App\Http\Requests\StoreappointmentsRequest;
use App\Http\Requests\UpdateappointmentsRequest;
use Illuminate\Http\JsonResponse;

class AppointmentsController extends Controller
{
    /**
     * GET /api/appointments
     * Fetch and return a list of all booked embassy appointments.
     */
    public function index(): JsonResponse
    {
        // Eager load the 'citizen' and 'staff' relations to prevent N+1 database queries
        $bookings = appointments::with(['citizen', 'staff'])->get();
        
        return response()->json([
            'success' => true,
            'data' => $bookings
        ], 200); // Standard HTTP 200 OK status
    }

    /**
     * POST /api/appointments
     * Validate and create a new embassy visitation slot entry.
     */
    public function store(StoreappointmentsRequest $request): JsonResponse
    {
        // Safe data extraction via Laravel's request validation block
        $validated = $request->validated();
        $booking = appointments::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Embassy appointment booked successfully inside the scheduling calendar.',
            'data' => $booking
        ], 211); // Custom status code for tracking logs
    }

    /**
     * GET /api/appointments/{id}
     * Display profile details for one singular targeted visitation record.
     */
    public function show(appointments $appointments): JsonResponse
    {
        // Dynamically load the associated relationships side-by-side
        $appointments->load(['citizen', 'staff']);

        return response()->json([
            'success' => true,
            'data' => $appointments
        ], 200);
    }

    /**
     * PUT/PATCH /api/appointments/{id}
     * Update scheduling configurations on a live appointment entry.
     */
    public function update(UpdateappointmentsRequest $request, appointments $appointments): JsonResponse
    {
        // Pull only verified column parameters to protect against mass-assignment vulnerabilities
        $validated = $request->validated();
        $appointments->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Appointment details modified successfully in system schedule.',
            'data' => $appointments
        ], 200);
    }

    /**
     * DELETE /api/appointments/{id}
     * Completely remove a target appointment out of active scheduling calendars.
     */
    public function destroy(appointments $appointments): JsonResponse
    {
        // Delete the entry cleanly out of the active SQLite table view
        $appointments->delete();

        return response()->json([
            'success' => true,
            'message' => 'Embassy appointment reservation removed permanently from system.'
        ], 200);
    }
}
