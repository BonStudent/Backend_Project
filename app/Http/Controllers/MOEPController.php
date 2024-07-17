<?php

namespace App\Http\Controllers;

use App\Models\MOEP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MOEPController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'applicant' => 'required|string|max:255',
            'moep_no' => 'required|string|max:255',
            'permit_no' => 'required|string|max:255',
            'issued' => 'required|date',
            'validated' => 'required|date',
            'reportPDF' => 'required|string|max:255'
        ]);

        $reportPath = $request->file('reportPDF')->store('reports', 'public');

        $MOEP = MOEP::create([
            'applicant' => $request->applicant,
            'moep_no' => $request->moep_no,
            'permit_no' => $request->permit_no,
            'issued' => $request->issued,
            'validated' => $request->validated,
            'reportPDF' => $reportPath,
        ]);

        return response()->json($MOEP, 201);
    }

    public function index() {
        $MOEP = MOEP::all();
        foreach ($MOEP as $MOEP) {
            $MOEP->reportPDF = url('storage/' . $MOEP->reportPDF);
        }
        return response()->json($MOEP);
    }
}