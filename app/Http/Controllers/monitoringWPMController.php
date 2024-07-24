<?php

namespace App\Http\Controllers;

use App\Models\monitoringWPM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class monitoringWPMController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'text_field' => 'required|string',
            'travel_date' => 'required|date',
            'report_date' => 'required|date',
            'transmittal_date' => 'required|date',
            'released_date' => 'required|date',
            'mmd_personnel' => 'required|string',
            'MOVpdf' => 'required|mimes:pdf|max:5120',
        ]);

        $file = $request->file('MOVpdf');
        $filePath = $file->store('public/Work_Program_Monitoring');

        $monitoringWPM = monitoringWPM::create([
            'text_field' => $request->input('text_field'),
            'travel_date' => $request->input('travel_date'),
            'report_date' => $request->input('report_date'),
            'transmittal_date' => $request->input('transmittal_date'),
            'released_date' => $request->input('released_date'),
            'mmd_personnel' => $request->input('mmd_personnel'),
            'MOVpdf' => $filePath,
        ]);

        return response()->json($monitoringWPM);
    }

    public function index()
    {
        return response()->json(monitoringWPM::all());
    }
}