<?php

namespace App\Http\Controllers;

use App\Models\MonitoringInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class MonitoringInventoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'location' => 'required|string',
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
                $filePath = $file->store('public/Inventory');
            } else {
                return response()->json(['message' => 'Uploaded file is not valid'], 400);
            }
        }

        $MonitoringInventory = MonitoringInventory::create([
            'month' => $request->input('month'),
            'location' => $request->input('location'),
            'travel_date_from' => $request->input('travel_date_from'),
            'travel_date_to' => $request->input('travel_date_to'),
            'report_date' => $request->input('report_date'),
            'transmittal_date' => $request->input('transmittal_date'),
            'released_date' => $request->input('released_date'),
            'mmd_personnel' => $request->input('mmd_personnel'),
            'MOVpdf' => $filePath,
        ]);

        return response()->json($MonitoringInventory);
    }

    /**
     * Display a listing of the MonitoringInventory entries.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(MonitoringInventory::all());
    }

    /**
     * Remove the specified MonitoringInventory entry from storage.
     *
     * @param  int  $ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $MonitoringInventory = MonitoringInventory::find($id);

        if (!$MonitoringInventory) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        try {
            if ($MonitoringInventory->MOVpdf) {
                Storage::delete($MonitoringInventory->MOVpdf);
            }

            $MonitoringInventory->delete();
            return response()->json(['message' => 'Entry deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete entry', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified MonitoringInventory entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find the MonitoringInventory entry by id
        $MonitoringInventory = MonitoringInventory::find($id);
    
        if (!$MonitoringInventory) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        $validatedData = $request->validate([
            'month' => 'required|string',
            'location' => 'required|string',
            'travel_date_from' => 'nullable|date',
            'travel_date_to' => 'nullable|date',
            'report_date' => 'nullable|date',
            'transmittal_date' => 'nullable|date',
            'released_date' => 'nullable|date',
            'mmd_personnel' => 'nullable|string',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120',
        ]);
    
        // Handle file upload if present
        if ($request->hasFile('MOVpdf')) {
            // Delete the old file if it exists
            if ($MonitoringInventory->MOVpdf) {
                Storage::disk('public')->delete($MonitoringInventory->MOVpdf);
            }
    
            // Store the new file
            $filePath = $request->file('MOVpdf')->store('public/Inventory');
            $validatedData['MOVpdf'] = $filePath;
        } else {
            // If no file is uploaded, ensure the existing file path remains unchanged
            $validatedData['MOVpdf'] = $MonitoringInventory->MOVpdf;
        }
    
        // Update the MonitoringInventory entry with the validated data
        $MonitoringInventory->update($validatedData);
    
        // Return the updated entry as a JSON response
        return response()->json($MonitoringInventory);
    }

    public function show($ID)
    {
        $data = MonitoringInventory::find($ID);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }
}
