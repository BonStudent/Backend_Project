<?php

namespace App\Http\Controllers;

use App\Models\monitoringOSTC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class monitoringOSTCController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required|string',
            'certification_no' => 'required|string',
            'received_ord' => 'nullable|date',
            'received_mmd' => 'nullable|date',
            'payment_date' => 'nullable|date',
            'sample_inspection' => 'nullable|string',
            'issued' => 'nullable|required|date',
            'mmd_personnel' => 'nullable|required|string',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('MOVpdf')) {
            $file = $request->file('MOVpdf');
            
            // Check if the file is indeed a valid instance of UploadedFile
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $filePath = $file->store('public/OSTC');
            } else {
                return response()->json(['message' => 'Uploaded file is not valid'], 400);
            }
        }

        $monitoringOSTC = monitoringOSTC::create([
            'client' => $request->input('client'),
            'certification_no' => $request->input('certification_no'),
            'received_ord' => $request->input('received_ord'),
            'received_mmd' => $request->input('received_mmd'),
            'payment_date' => $request->input('payment_date'),
            'sample_inspection' => $request->input('sample_inspection'),
            'issued' => $request->input('issued'),
            'mmd_personnel' => $request->input('mmd_personnel'),
            'MOVpdf' => $filePath,
        ]);

        return response()->json($monitoringOSTC);
    }


    public function index()
    {
        return response()->json(monitoringOSTC::all());
    }
}