<?php

namespace App\Http\Controllers;

use App\Models\MOEP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MOEPController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'applicant' => 'required|string',
            'moep_no' => 'required|string',
            'permit_no' => 'required|string',
            'issued' => 'required|date',
            'validated' => 'required|date',
            'reportPDF' => 'required|mimes:pdf|max:10240',
        ]);

        $file = $request->file('reportPDF');
        $filePath = $file->store('public/MOEP');

        $MOEP = MOEP::create([
            'applicant' => $request->input('applicant'),
            'moep_no' => $request->input('moep_no'),
            'permit_no' => $request->input('permit_no'),
            'issued' => $request->input('issued'),
            'validated' => $request->input('validated'),
            'reportPDF' => $filePath,
        ]);

        return response()->json($MOEP);
    }

    public function index()
    {
        return response()->json(MOEP::all());
    }
}