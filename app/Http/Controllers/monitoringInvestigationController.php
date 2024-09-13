<?php

namespace App\Http\Controllers;

use App\Models\MonitoringInvestigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Add this for generating random strings
use Exception;

class MonitoringInvestigationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'text_field' => 'required|string',
            'complaint_received' => 'required|string',
            'date_acted' => 'nullable|date',
            'report_date' => 'nullable|date',
            'transmittal_date' => 'nullable|date',
            'released_date' => 'nullable|date',
            'mmd_personnel' => 'nullable|string',
            'remarks' => 'nullable|string',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120',
            'coordinates' => 'nullable|string',
        ]);
        $filePath = null;

        if ($request->hasFile('MOVpdf')) {
            $file = $request->file('MOVpdf');
            
            // Check if the file is indeed a valid instance of UploadedFile
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $filePath = $file->store('public/Investigation');
            } else {
                return response()->json(['message' => 'Uploaded file is not valid'], 400);
            }
        }

        $MonitoringInvestigation = MonitoringInvestigation::create([
            'month' => $request->input('month'),
            'text_field' => $request->input('text_field'),
            'complaint_received' => $request->input('complaint_received'),
            'date_acted' => $request->input('date_acted'),
            'report_date' => $request->input('report_date'),
            'transmittal_date' => $request->input('transmittal_date'),
            'released_date' => $request->input('released_date'),
            'mmd_personnel' => $request->input('mmd_personnel'),
            'remarks' => $request->input('remarks'),
            'MOVpdf' => $filePath,
            'coordinates' => $request->input('coordinates'),
        ]);

        return response()->json($MonitoringInvestigation);
    }

    public function index()
    {
        return response()->json(MonitoringInvestigation::all());
    }

    /**
     * Remove the specified MonitoringInvestigation entry from storage.
     *
     * @param  int  $ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($ID)
    {
        $MonitoringInvestigation = MonitoringInvestigation::find($ID);

        if (!$MonitoringInvestigation) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        try {
            if ($MonitoringInvestigation->MOVpdf) {
                Storage::delete($MonitoringInvestigation->MOVpdf);
            }

            $MonitoringInvestigation->delete();
            return response()->json(['message' => 'Entry deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete entry', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified MonitoringInvestigation entry.
     *
     * @param  int  $ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($ID)
    {
        $data = MonitoringInvestigation::find($ID);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    /**
     * Update the specified MonitoringInvestigation entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $ID)
    {
        // Find the MonitoringInvestigation entry by ID
        $MonitoringInvestigation = MonitoringInvestigation::find($ID);
    
        if (!$MonitoringInvestigation) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'month' => 'required|string',
            'text_field' => 'required|string',
            'complaint_received' => 'required|string',
            'date_acted' => 'nullable|date',
            'report_date' => 'nullable|date',
            'transmittal_date' => 'nullable|date',
            'released_date' => 'nullable|date',
            'mmd_personnel' => 'nullable|string',
            'remarks' => 'nullable|string',
            'MOVpdf' => 'required|file|mimes:pdf|max:5120',
            'coordinates' => 'nullable|string',
        ]);
    
        // Handle file upload if present
        if ($request->hasFile('MOVpdf')) {
            // Delete the old file if it exists
            if ($MonitoringInvestigation->MOVpdf) {
                Storage::disk('public')->delete($MonitoringInvestigation->MOVpdf);
            }
    
            // Store the new file
            $filePath = $request->file('MOVpdf')->store('public/Investigation');
            $validatedData['MOVpdf'] = $filePath;
        } else {
            // If no file is uploaded, ensure the existing file path remains unchanged
            $validatedData['MOVpdf'] = $MonitoringInvestigation->MOVpdf;
        }
    
        // Update the MonitoringInvestigation entry with the validated data
        $MonitoringInvestigation->update($validatedData);
    
        // Return the updated entry as a JSON response
        return response()->json($MonitoringInvestigation);
    }   
}