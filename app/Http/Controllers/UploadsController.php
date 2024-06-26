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
            'file13',
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

    public function update(Request $request)
    {
        $validatedData = $request->validate([
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

        $id_reference = $validatedData['id_reference'];

        // $upload = Uploads::where('id_reference', $id_reference)->firstOrNew(); // Retrieve the upload record
        $upload = Uploads::firstOrNew(['id_reference' => $id_reference]);

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
            'file13',
            'file14',
            'file15',
            'file16',
            'file17',
            'file18',
            'file19',
            'file20'
        ];

        $newFiles = [];

        foreach ($fileKeys as $fileKey) {
            if ($request->hasFile($fileKey)) {
                foreach ($request->file($fileKey) as $file) {
                    // Use getClientOriginalName to get the original file name
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    // Construct the path including the original name and extension
                    $path = "public/uploads/{$fileKey}/{$originalName}";
                    // Store the file with its original name
                    $file->storeAs("public/uploads/{$fileKey}", $originalName, 'public');

                    // Store only the original file name
                    $newFiles[$fileKey][] = $originalName;

                    // Delete old file if exists
                    if (isset($upload->$fileKey)) {
                        $oldFilePaths = json_decode($upload->$fileKey, true);
                        foreach ($oldFilePaths as $oldPath) {
                            Storage::delete($oldPath);
                        }
                        unset($upload->$fileKey); // Remove old file path from model
                    }
                }
            } else {
                // No new files, just clean up old ones
                if (isset($upload->$fileKey)) {
                    $oldFilePaths = json_decode($upload->$fileKey, true);
                    foreach ($oldFilePaths as $oldPath) {
                        Storage::delete($oldPath);
                    }
                    unset($upload->$fileKey); // Remove old file path from model
                }
            }
        }

        $newUpload = new Uploads;

        // Update the model with new file paths
        foreach ($newFiles as $fileKey => $paths) {
            $upload->$fileKey = json_encode(array_values($paths));
            $newUpload->$fileKey = json_encode(array_values($paths));
        }
        // Before saving, ensure the upload has been modified
        if (!$upload->isDirty()) {
            // Optionally, handle the case where no changes were made
            return response()->json([
                'message' => 'No changes detected.',
            ], 304);
        }

        // $upload->save();
        if (!$upload) {
            $newUpload->save();
        } else {
            $upload->save();
        }

        return response()->json([
            'message' => 'Update successful',
            'updated_files' => $newFiles,
        ], 200);
    }


}