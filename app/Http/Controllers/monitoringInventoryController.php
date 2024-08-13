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

    public function index()
    {
        return response()->json(MonitoringInventory::all());
    }

    public function destroy($ID)
    {
        // Log the id being used
        \Log::info('Attempting to delete inventory with id: ' . $ID);

        // Retrieve the inventory entry using the Query Builder
        $inventory = \DB::table('monitoring_inventory')->where('ID', $ID)->first();

        // Check if the inventory entry exists
        if (!$inventory) {
            \Log::warning('No inventory found with ID: ' . $ID);
            return response()->json(['message' => 'Entry not found'], 404);
        }

        // Delete the file if it exists
        if ($inventory->MOVpdf) {
            Storage::delete($inventory->MOVpdf);
        }

        // Delete the inventory entry
        \DB::table('monitoring_inventory')->where('ID', $ID)->delete();

        return response()->json(['message' => 'Entry deleted successfully']);
    }

    public function update(Request $request, $ID)
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

        $MonitoringInventory = MonitoringInventory::find($ID);

        if (!$MonitoringInventory) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        DB::beginTransaction();

        try {
            $filePath = $MonitoringInventory->MOVpdf;

            if ($request->hasFile('MOVpdf')) {
                $file = $request->file('MOVpdf');
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    if ($filePath) {
                        Storage::delete($filePath);
                    }
                    $filePath = $file->store('public/Inventory');
                } else {
                    return response()->json(['message' => 'Uploaded file is not valid'], 400);
                }
            }

            $MonitoringInventory->update([
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

            DB::commit();
            return response()->json($MonitoringInventory);
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('Failed to update entry: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update entry'], 500);
        }
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
