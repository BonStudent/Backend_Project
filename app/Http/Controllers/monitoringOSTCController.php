<?php

namespace App\Http\Controllers;

use App\Models\monitoringOSTC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonitoringOSTCController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required|string',
            'certification_no' => 'required|string',
            'received_ord' => 'nullable|date',
            'received_mmd' => 'nullable|date',
            'payment_date' => 'nullable|date',
            'sample_inspection' => 'nullable|date',
            'issued' => 'required|date',
            'mmd_personnel' => 'nullable|string',
            'MOVpdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('MOVpdf')) {
            $file = $request->file('MOVpdf');
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

    public function destroy($no)
    {
        // Find the entry by its ID
        $monitoringOSTC = monitoringOSTC::find($no);

        if (!$monitoringOSTC) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        // Delete the associated file if it exists
        if ($monitoringOSTC->MOVpdf) {
            Storage::delete($monitoringOSTC->MOVpdf);
        }

        // Delete the entry from the database
        $monitoringOSTC->delete();

        return response()->json(['message' => 'Entry deleted successfully']);
    }

    //
    //
    public function update(Request $request, $no)
    {
        // Find the entry by its ID
        $monitoringOSTC = monitoringOSTC::find($no);
    
        if (!$monitoringOSTC) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
    
        // Handle the file upload
        $filePath = $monitoringOSTC->MOVpdf;
    
        if ($request->hasFile('MOVpdf')) {
            $file = $request->file('MOVpdf');
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                // Delete old file if it exists
                if ($filePath) {
                    Storage::delete($filePath);
                }
                $filePath = $file->store('public/OSTC');
            } else {
                return response()->json(['message' => 'Uploaded file is not valid'], 400);
            }
        }
    
        // Update the entry
        $monitoringOSTC->update([
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

    public function show($no)
    {
        $data = MonitoringOSTC::find($no);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }
}
