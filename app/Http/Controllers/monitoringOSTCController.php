<?php

namespace App\Http\Controllers;

use App\Models\MonitoringOSTC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

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
            'MOVpdf' => 'nullable|mimes:pdf|max:5120', // Ensure the file is a PDF and max size is 5MB
        ]);

        DB::beginTransaction();

        try {
            $filePath = null;

            if ($request->hasFile('MOVpdf')) {
                $file = $request->file('MOVpdf');
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $filePath = $file->store('public/OSTC');
                } else {
                    return response()->json(['message' => 'Uploaded file is not valid'], 400);
                }
            }

            $MonitoringOSTC = MonitoringOSTC::create([
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

            DB::commit();
            return response()->json($MonitoringOSTC, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to store entry'], 500);
        }
    }

    public function index()
    {
        return response()->json(MonitoringOSTC::all());
    }

    public function destroy($no)
    {
        $MonitoringOSTC = MonitoringOSTC::find($no);

        if (!$MonitoringOSTC) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        try {
            if ($MonitoringOSTC->MOVpdf) {
                Storage::delete($MonitoringOSTC->MOVpdf);
            }

            $MonitoringOSTC->delete();
            return response()->json(['message' => 'Entry deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete entry'], 500);
        }
    }

    public function update(Request $request, $no)
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

        $MonitoringOSTC = MonitoringOSTC::find($no);

        if (!$MonitoringOSTC) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        DB::beginTransaction();

        try {
            $filePath = $MonitoringOSTC->MOVpdf;

            if ($request->hasFile('MOVpdf')) {
                $file = $request->file('MOVpdf');
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    if ($filePath) {
                        Storage::delete($filePath);
                    }
                    $filePath = $file->store('public/OSTC');
                } else {
                    return response()->json(['message' => 'Uploaded file is not valid'], 400);
                }
            }

            $MonitoringOSTC->update([
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

            DB::commit();
            return response()->json($MonitoringOSTC);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update entry'], 500);
        }
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
