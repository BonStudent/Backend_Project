<!-- MOEPController.php -->
<?php

namespace App\Http\Controllers;

use App\Models\MOEP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MOEPController extends Controller
{
    public function index()
    {
        return response()->json(MOEP::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'applicant' => 'required|string|max:255',
            'moep_no' => 'required|string|max:255',
            'permit_no' => 'required|string|max:255',
            'issued' => 'required|date',
            'validated' => 'required|date',
            'reportPDF' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('reportPDF');
        $filePath = $file->store('public/MOEP');

        $MOEP = MOEP::create([
            'applicant' => $request->applicant,
            'moep_no' => $request->moep_no,
            'permit_no' => $request->permit_no,
            'issued' => $request->issued,
            'validated' => $request->validated,
            'reportPDF' => $filePath,
        ]);

        return response()->json($MOEP, 201);
    }
}
