<?php

namespace App\Http\Controllers;

use App\Models\MonitoringWPM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonitoringWPMController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'text_field' => 'required|string',
            'travel_date_from' => 'nullable|date',
            'travel_date_to' => 'nullable|date',
            'report_date' => 'nullable|date',
            'transmittal_date' => 'nullable|date',
            'released_date' => 'nullable|date',
            'mmd_personnel' => 'nullable|string',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('MOVpdf')) {
            $file = $request->file('MOVpdf');
            
            // Check if the file is indeed a valid instance of UploadedFile
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $filePath = $file->store('public/Work_Program_Monitoring');
            } else {
                return response()->json(['message' => 'Uploaded file is not valid'], 400);
            }
        }

        $MonitoringWPM = MonitoringWPM::create([
            'month' => $request->input('month'),
            'text_field' => $request->input('text_field'),
            'travel_date_from' => $request->input('travel_date_from'),
            'travel_date_to' => $request->input('travel_date_to'),
            'report_date' => $request->input('report_date'),
            'transmittal_date' => $request->input('transmittal_date'),
            'released_date' => $request->input('released_date'),
            'mmd_personnel' => $request->input('mmd_personnel'),
            'MOVpdf' => $filePath,
        ]);

        return response()->json($MonitoringWPM);
    }

    public function index()
    {
        return response()->json(MonitoringWPM::all());
    }

    /**
     * Remove the specified MonitoringWPM entry from storage.
     *
     * @param  int  $ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($ID)
    {
        $MonitoringWPM = MonitoringWPM::find($ID);

        if (!$MonitoringWPM) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        try {
            if ($MonitoringWPM->MOVpdf) {
                Storage::delete($MonitoringWPM->MOVpdf);
            }

            $MonitoringWPM->delete();
            return response()->json(['message' => 'Entry deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete entry', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified MonitoringWPM entry.
     *
     * @param  int  $no
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($ID)
    {
        $data = MonitoringWPM::find($ID);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    /**
     * Update the specified MonitoringWPM entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $ID)
    {
        // Find the MonitoringWPM entry by ID
        $MonitoringWPM = MonitoringWPM::find($ID);
    
        if (!$MonitoringWPM) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'month' => 'required|string',
            'text_field' => 'required|string',
            'travel_date_from' => 'nullable|date',
            'travel_date_to' => 'nullable|date',
            'report_date' => 'nullable|date',
            'transmittal_date' => 'nullable|date',
            'released_date' => 'nullable|date',
            'mmd_personnel' => 'nullable|string',
            'MOVpdf' => 'required|file|mimes:pdf|max:5120',
        ]);
    
        // Handle file upload if present
        if ($request->hasFile('MOVpdf')) {
            // Delete the old file if it exists
            if ($MonitoringWPM->MOVpdf) {
                Storage::disk('public')->delete($MonitoringWPM->MOVpdf);
            }
    
            // Store the new file
            $filePath = $request->file('MOVpdf')->store('public/Work_Program_Monitoring');
            $validatedData['MOVpdf'] = $filePath;
        } else {
            // If no file is uploaded, ensure the existing file path remains unchanged
            $validatedData['MOVpdf'] = $MonitoringWPM->MOVpdf;
        }
    
        // Update the MonitoringWPM entry with the validated data
        $MonitoringWPM->update($validatedData);
    
        // Return the updated entry as a JSON response
        return response()->json($MonitoringWPM);
    }
}