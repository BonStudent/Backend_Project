<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Import the Str class for UUID generation

class UploadsController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'id_reference' => 'required|integer',
            'file1.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file2.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file3.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file4.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file5.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file6.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file7.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file8.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file9.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file10.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file11.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file12.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file13.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file14.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file15.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file16.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file17.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file18.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file19.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file20.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $fileKeys = [
            'file1',
            'file2',
            'file3',
            'file4',
            'file5',
            'file6',
            'file7',
            'file8',
            'file9',
            'file10',
            'file11',
            'file12',
            'file13'
            ,
            'file14',
            'file15',
            'file16',
            'file17',
            'file18',
            'file19',
            'file20'
        ];
        $filePaths = [];

        foreach ($fileKeys as $fileKey) {
            if ($request->hasFile($fileKey)) {
                foreach ($request->file($fileKey) as $file) {
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = Str::uuid() . '.' . $fileExtension; // Generate UUID for file name
                    $filePath = $file->storeAs('public/uploads/' . $fileKey, $fileName);
                    $filePaths[$fileKey][] = $filePath;
                }
            }
        }

        // Debug: Log file paths
        \Log::info('File paths:', $filePaths);

        // Save the file paths in the database
        $upload = new Uploads();
        $upload->id_reference = $request->id_reference;

        foreach ($fileKeys as $fileKey) {
            $upload->$fileKey = json_encode($filePaths[$fileKey] ?? []);
        }

        $upload->save();

        return response()->json([
            'message' => $request->validate([
                'id_reference' => 'required|integer',
                'file1.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file2.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file3.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file4.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file5.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file6.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file7.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file8.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file9.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file10.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file11.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file12.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file13.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file14.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file15.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file16.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file17.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file18.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file19.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'file20.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            ])
        ], 201);
    }

    public function update(Request $request, $id_reference)
    {
        // Try to find the record by id_reference
        $uploads = Uploads::where('id_reference', $id_reference)->first();

        // Validate incoming request data
        $validatedData = $request->validate([
            // 'id_reference' => 'required|integer',
            'file1.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file2.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file3.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file4.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file5.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file6.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file7.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file8.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file9.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file10.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file11.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file12.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file13.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file14.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file15.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file16.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file17.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file18.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file19.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file20.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $fileKeys = ['file1', 'file2', 'file3', 'file4', 'file5', 'file6', 'file7', 'file8', 'file9', 'file10', 'file11', 'file12', 'file13', 'file14', 'file15', 'file16', 'file17', 'file18', 'file19', 'file20'];
        $filePaths = [];

        foreach ($fileKeys as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $filePaths[$fileKey] = [];
                foreach ($request->file($fileKey) as $file) {
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = Str::uuid(). '.'. $fileExtension; // Generate UUID for file name
                    $filePath = $file->storeAs('public/uploads/'. $fileKey, $fileName);
                    $filePaths[$fileKey][] = $filePath;
                }
                \Log::info('Stored file paths for '. $fileKey. ': '. json_encode($filePaths[$fileKey]));
            } else {
                $filePaths[$fileKey] = [];
            }
        }
        
        if ($uploads) {
            // Save the file paths in the database
            foreach ($fileKeys as $fileKey) {
                $uploads->$fileKey = $filePaths[$fileKey]; // Removed manual JSON encoding
            }
            $uploads->save();
        
            // Update the recommendation with the new data
            $uploads->update($validatedData);
        
            return response()->json(['message' => 'Record updated successfully'], 200);
        } else {
            // Create a new recommendation instance
            $newUploads = new Uploads();
        
            // Fill the new recommendation with the validated data
            $newUploads->fill($validatedData);
        
            // Save the file paths in the database
            foreach ($fileKeys as $fileKey) {
                $newUploads->$fileKey = $filePaths[$fileKey]; // Removed manual JSON encoding
            }
        
            // Save the new recommendation
            $newUploads->save();
        
            return response()->json(['message' => 'New record created successfully'], 200);
        }
}
}