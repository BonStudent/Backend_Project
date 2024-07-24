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
            'received_ord' => 'required|date',
            'received_mmd' => 'required|date',
            'payment_date' => 'required|date',
            'sample_inspection' => 'required|string',
            'issued' => 'required|date',
            'mmd_personnel' => 'required|string',
            'MOVpdf' => 'required|mimes:pdf|max:5120',
        ]);

        $file = $request->file('MOVpdf');
        $filePath = $file->store('public/OSTC');

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