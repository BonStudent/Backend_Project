<?php

namespace App\Http\Controllers;

use App\Models\MonitoringInvestigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}