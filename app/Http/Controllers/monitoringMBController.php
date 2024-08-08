<?php

namespace App\Http\Controllers;

use App\Models\monitoringMB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class monitoringMBController extends Controller
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

        $monitoringMB = monitoringMB::create([
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

        return response()->json($monitoringMB, 201);
    }

    public function index()
    {
        return response()->json(monitoringMB::all(), 200);
    }
}
