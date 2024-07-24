<?php

namespace App\Http\Controllers;

use App\Models\monitoringInvestigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class monitoringInvestigationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'text_field' => 'required|string',
            'complaint_received' => 'required|string',
            'date_acted_from' => 'required|date',
            'date_acted_to' => 'required|date',
            'report_date' => 'required|date',
            'transmittal_date' => 'required|date',
            'released_date' => 'required|date',
            'mmd_personnel' => 'required|string',
            'remarks' => 'required|string',
            'MOVpdf' => 'required|mimes:pdf|max:5120',
        ]);

        $file = $request->file('MOVpdf');
        $filePath = $file->store('public/Investigation');

        $monitoringInvestigation = monitoringInvestigation::create([
            'text_field' => $request->input('text_field'),
            'complaint_received' => $request->input('complaint_received'),
            'date_acted_from' => $request->input('date_acted_from'), //from-to
            'date_acted_to' => $request->input('date_acted_to'),
            'report_date' => $request->input('report_date'),
            'transmittal_date' => $request->input('transmittal_date'),
            'released_date' => $request->input('released_date'),
            'mmd_personnel' => $request->input('mmd_personnel'),
            'remarks' => $request->input('remarks'),
            'MOVpdf' => $filePath,
        ]);

        return response()->json($monitoringInvestigation);
    }

    public function index()
    {
        return response()->json(monitoringInvestigation::all());
    }
}