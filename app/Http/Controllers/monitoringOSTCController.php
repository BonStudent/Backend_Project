<?php

namespace App\Http\Controllers;

use App\Models\MonitoringOSTC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Add this for generating random strings
use Exception;

class MonitoringOSTCController extends Controller
{
    /**
     * Store a newly created MonitoringOSTC entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client' => 'required|string',
            'certification_no' => 'required|string',
            'received_ord' => 'nullable|date',
            'received_mmd' => 'nullable|date',
            'payment_date' => 'nullable|date',
            'sample_inspection' => 'nullable|date',
            'issued' => 'required|date',
            'mmd_personnel' => 'nullable|string',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120', // Ensure the file is a PDF and max size is 5MB
        ]);

        // Initialize the file path variable
        $filePath = '';

        // Check if the request contains a file named 'MOVpdf'
        if ($request->hasFile('MOVpdf')) {
            $file = $request->file('MOVpdf');
            $filePath = $file->store('public/OSTC');
        }

        // Create a new MonitoringOSTC entry with the validated data
        $MonitoringOSTC = MonitoringOSTC::create(array_merge($validatedData, ['MOVpdf' => $filePath]));

        // Return the newly created entry as a JSON response
        return response()->json($MonitoringOSTC);
    }

    /**
     * Display a listing of the MonitoringOSTC entries.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(MonitoringOSTC::all());
    }

    /**
     * Remove the specified MonitoringOSTC entry from storage.
     *
     * @param  int  $no
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($no)
    {
        $MonitoringOSTC = MonitoringOSTC::find($no);

        if (!$MonitoringOSTC) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        try {
            if ($MonitoringOSTC->MOVpdf) {
                Storage::delete($MonitoringOSTC->MOVpdf);
            }

            $MonitoringOSTC->delete();
            return response()->json(['message' => 'Entry deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete entry', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified MonitoringOSTC entry.
     *
     * @param  int  $no
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($no)
    {
        $data = MonitoringOSTC::find($no);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    /**
     * Update the specified MonitoringOSTC entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $no
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $no)
    {
        // Find the MonitoringOSTC entry by no
        $MonitoringOSTC = MonitoringOSTC::find($no);
    
        if (!$MonitoringOSTC) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client' => 'required|string',
            'certification_no' => 'required|string',
            'received_ord' => 'nullable|date',
            'received_mmd' => 'nullable|date',
            'payment_date' => 'nullable|date',
            'sample_inspection' => 'nullable|date',
            'issued' => 'required|date',
            'mmd_personnel' => 'nullable|string',
            'MOVpdf' => 'required|file|mimes:pdf|max:5120', // Ensure the file is a PDF and max size is 5MB
        ]);
        
    
        // Handle file upload if present
        if ($request->hasFile('MOVpdf')) {
            // Delete the old file if it exists
            if ($MonitoringOSTC->MOVpdf) {
                Storage::disk('public')->delete($MonitoringOSTC->MOVpdf);
            }
    
            // Store the new file
            $filePath = $request->file('MOVpdf')->store('public/OSTC');
            $validatedData['MOVpdf'] = $filePath;
        } else {
            // If no file is uploaded, ensure the existing file path remains unchanged
            $validatedData['MOVpdf'] = $MonitoringOSTC->MOVpdf;
        }
    
        // Update the MonitoringOSTC entry with the validated data
        $MonitoringOSTC->update($validatedData);
    
        // Return the updated entry as a JSON response
        return response()->json($MonitoringOSTC);
    }
}
