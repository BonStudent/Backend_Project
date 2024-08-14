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
}