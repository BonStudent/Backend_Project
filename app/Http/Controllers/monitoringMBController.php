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
            'travel_date' => 'required|date',
            'report_date' => 'required|date',
            'transmittal_date' => 'required|date',
            'released_date' => 'required|date',
            'mmd_personnel' => 'required|string',
            'MOVpdf' => 'required|mimes:pdf|max:5120',
            'map' => 'required|mimes:jpeg|max:5120',
        ]);

        $file_a = $request->file('MOVpdf');
        $file_b = $request->file('map');
        $filePath_a = $file_a->store('public/Minahang_Bayan_Monitoring');
        $filePath_b = $file_b->store('public/Minahang_Bayan_Monitoring');

        $monitoringMB = monitoringMB::create([
            'month' => $request->input('month'),
            'petitioner' => $request->input('petitioner'),
            'location' => $request->input('location'),
            'travel_date' => $request->input('travel_date'),
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
