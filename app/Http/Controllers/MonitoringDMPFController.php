<?php

namespace App\Http\Controllers;

use App\Models\MonitoringDMPF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Add this for generating random strings
use Exception;

class MonitoringDMPFController extends Controller
{
    /**
     * Store a newly created MonitoringDMPF entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'month' => 'required|string',
            'dmpf_endorsed' => 'required|string',
            'filing_date' => 'nullable|date',
            'endorsed' => 'nullable|date',
            'transmittal' => 'nullable|date',
            'released' => 'required|date',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120', // Ensure the file is a PDF and max size is 5MB
        ]);

        // Initialize the file path variable
        $filePath = '';

        // Check if the request contains a file named 'MOVpdf'
        if ($request->hasFile('MOVpdf')) {
            $file = $request->file('MOVpdf');
            $filePath = $file->store('public/DMPF');
        }

        // Create a new MonitoringDMPF entry with the validated data
        $MonitoringDMPF = MonitoringDMPF::create(array_merge($validatedData, ['MOVpdf' => $filePath]));

        // Return the newly created entry as a JSON response
        return response()->json($MonitoringDMPF);
    }

    /**
     * Display a listing of the MonitoringDMPF entries.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(MonitoringDMPF::all());
    }

    /**
     * Remove the specified MonitoringDMPF entry from storage.
     *
     * @param  int  $no
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($no)
    {
        $MonitoringDMPF = MonitoringDMPF::find($no);

        if (!$MonitoringDMPF) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        try {
            if ($MonitoringDMPF->MOVpdf) {
                Storage::delete($MonitoringDMPF->MOVpdf);
            }

            $MonitoringDMPF->delete();
            return response()->json(['message' => 'Entry deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete entry', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified MonitoringDMPF entry.
     *
     * @param  int  $no
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($no)
    {
        $data = MonitoringDMPF::find($no);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    /**
     * Update the specified MonitoringDMPF entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $no
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $no)
    {
        // Find the MonitoringDMPF entry by ID
        $MonitoringDMPF = MonitoringDMPF::find($no);
    
        if (!$MonitoringDMPF) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'month' => 'required|string',
            'dmpf_endorsed' => 'required|string',
            'filing_date' => 'nullable|date',
            'endorsed' => 'nullable|date',
            'transmittal' => 'nullable|date',
            'released' => 'required|date',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120', // Ensure the file is a PDF and max size is 5MB
        ]);
    
        // Handle file upload if present
        if ($request->hasFile('MOVpdf')) {
            // Delete the old file if it exists
            if ($MonitoringDMPF->MOVpdf) {
                Storage::disk('public')->delete($MonitoringDMPF->MOVpdf);
            }
    
            // Store the new file
            $filePath = $request->file('MOVpdf')->store('public/DMPF');
            $validatedData['MOVpdf'] = $filePath;
        } else {
            // If no file is uploaded, ensure the existing file path remains unchanged
            $validatedData['MOVpdf'] = $MonitoringDMPF->MOVpdf;
        }
    
        // Update the MonitoringDMPF entry with the validated data
        $MonitoringDMPF->update($validatedData);
    
        // Return the updated entry as a JSON response
        return response()->json($MonitoringDMPF);
    }
}
