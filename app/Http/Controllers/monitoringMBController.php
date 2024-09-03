<?php

namespace App\Http\Controllers;

use App\Models\MonitoringMB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonitoringMBController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'petitioner' => 'required|string',
            'location' => 'required|string',
            'travel_date_from' => 'nullable|date',
            'travel_date_to' => 'nullable|date',
            'report_date' => 'nullable|date',
            'transmittal_date' => 'nullable|date',
            'released_date' => 'nullable|date',
            'mmd_personnel' => 'nullable|string',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120',
            'map' => 'nullable|mimes:jpeg|max:5120',
        ]);

        $filePath_a = null;
        $filePath_b = null;

        if ($request->hasFile('MOVpdf')) {
            $file_a = $request->file('MOVpdf');
            $filePath_a = $file_a->store('public/Minahang_Bayan_Monitoring');
        }

        if ($request->hasFile('map')) {
            $file_b = $request->file('map');
            $filePath_b = $file_b->store('public/Minahang_Bayan_Monitoring');
        }

        $MonitoringMB = MonitoringMB::create([
            'month' => $request->input('month'),
            'petitioner' => $request->input('petitioner'),
            'location' => $request->input('location'),
            'travel_date_from' => $request->input('travel_date_from'),
            'travel_date_to' => $request->input('travel_date_to'),
            'report_date' => $request->input('report_date'),
            'transmittal_date' => $request->input('transmittal_date'),
            'released_date' => $request->input('released_date'),
            'mmd_personnel' => $request->input('mmd_personnel'),
            'MOVpdf' => $filePath_a,
            'map' => $filePath_b,
        ]);

        return response()->json($MonitoringMB, 201);
    }

    public function index()
    {
        return response()->json(MonitoringMB::all(), 200);
    }

    /**
     * Remove the specified MonitoringMB entry from storage.
     *
     * @param  int  $ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($ID)
    {
        $MonitoringMB = MonitoringMB::find($ID);

        if (!$MonitoringMB) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        try {
            if ($MonitoringMB->MOVpdf) {
                Storage::delete($MonitoringMB->MOVpdf);
            }

            $MonitoringMB->delete();
            return response()->json(['message' => 'Entry deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete entry', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified MonitoringMB entry.
     *
     * @param  int  $ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($ID)
    {
        $data = MonitoringMB::find($ID);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    /**
     * Update the specified MonitoringMB entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $ID)
    {
        // Find the MonitoringMB entry by ID
        $MonitoringMB = MonitoringMB::find($ID);
    
        if (!$MonitoringMB) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'month' => 'required|string',
            'petitioner' => 'required|string',
            'location' => 'required|string',
            'travel_date_from' => 'nullable|date',
            'travel_date_to' => 'nullable|date',
            'report_date' => 'nullable|date',
            'transmittal_date' => 'nullable|date',
            'released_date' => 'nullable|date',
            'mmd_personnel' => 'nullable|string',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120',
            'map' => 'nullable|mimes:jpeg|max:5120',
        ]);
    
        // Handle file upload if present
        if ($request->hasFile('MOVpdf')) {
            // Delete the old file if it exists
            if ($MonitoringMB->MOVpdf) {
                Storage::disk('public')->delete($MonitoringMB->MOVpdf);
            }
    
            // Store the new file
            $filePath = $request->file('MOVpdf')->store('public/Minahang_Bayan_Monitoring');
            $validatedData['MOVpdf'] = $filePath;
        } else {
            // If no file is uploaded, ensure the existing file path remains unchanged
            $validatedData['MOVpdf'] = $MonitoringMB->MOVpdf;
        }
    
        // Update the MonitoringMB entry with the validated data
        $MonitoringMB->update($validatedData);
    
        // Return the updated entry as a JSON response
        return response()->json($MonitoringMB);
    }


}
