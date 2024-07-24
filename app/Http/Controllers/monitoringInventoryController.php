<?php

namespace App\Http\Controllers;

use App\Models\monitoringInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class monitoringInventoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'location' => 'required|string',
            'travel_date' => 'required|date',
            'transmittal_date' => 'required|date',
            'released_date' => 'required|date',
            'mmd_personnel' => 'required|string',
            'MOVpdf' => 'required|mimes:pdf|max:5120',
        ]);

        $file = $request->file('MOVpdf');
        $filePath = $file->store('public/Inventory');

        $monitoringInventory = monitoringInventory::create([
            'month' => $request->input('month'),
            'location' => $request->input('location'),
            'travel_date' => $request->input('travel_date'),
            'transmittal_date' => $request->input('transmittal_date'),
            'released_date' => $request->input('released_date'),
            'mmd_personnel' => $request->input('mmd_personnel'),
            'MOVpdf' => $filePath,
        ]);

        return response()->json($monitoringInventory);
    }

    public function index()
    {
        return response()->json(monitoringInventory::all());
    }
}