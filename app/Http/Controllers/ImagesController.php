<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'id_reference' => 'required|integer',
            'file1.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file2.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file3.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file4.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file5.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file6.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file7.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file8.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file9.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file10.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file11.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file12.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file13.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file14.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file15.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file16.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file17.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file18.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file19.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file20.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
        ]);

        $filePaths = [];

        // Process each file input
        for ($i = 1; $i <= 20; $i++) {
            $fileKey = 'file' . $i;
            if ($request->hasFile($fileKey)) {
                foreach ($request->file($fileKey) as $file) {
                    // Store the file
                    $filePath = $file->store('public/images/' . $fileKey);
                    $filePaths[$fileKey][] = $filePath;
                }
            }
        }

        // Debug: Log file paths
        \Log::info('File paths:', $filePaths);

        // Save the file paths in the database
        $upload = new Images();
        $upload->id_reference = $request->id_reference;

        foreach ($filePaths as $fileKey => $paths) {
            $upload->$fileKey = json_encode($paths);
        }

        $upload->save();

        return response()->json([
            'message' => $request->validate([
                'id_reference' => 'required|integer',
                'file1.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file2.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file3.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file4.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file5.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file6.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file7.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file8.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file9.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file10.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file11.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file12.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file13.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file14.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file15.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file16.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file17.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file18.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file19.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'file20.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            ])
        ], 201);
    }

    public function update(Request $request, $id_reference)
    {
        $validatedData = $request->validate([
            // 'id_reference' => 'required|integer',
            'file1.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file2.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file3.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file4.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file5.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file6.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file7.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file8.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file9.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file10.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file11.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file12.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file13.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file14.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file15.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file16.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file17.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file18.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file19.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'file20.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
        ]);

        // $id_reference = $validatedData['id_reference'];
        $image = Images::firstOrNew(['id_reference' => $id_reference]);

        // Define all possible file keys
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

        // Process new uploads
        foreach ($fileKeys as $fileKey) {
            if ($request->hasFile($fileKey)) {
                foreach ($request->file($fileKey) as $file) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $path = "public/images/{$fileKey}/{$originalName}";
                    $file->storeAs("public/images/{$fileKey}", $originalName, 'public');
                    $newFiles[$fileKey][] = $originalName;
                }
            }
        }

        // Delete old files if there are no new files
        foreach ($fileKeys as $fileKey) {
            if (!isset($newFiles[$fileKey]) || empty($newFiles[$fileKey])) {
                if (isset($image->$fileKey)) {
                    $oldFilePaths = json_decode($image->$fileKey, true);
                    foreach ($oldFilePaths as $oldPath) {
                        Storage::delete($oldPath);
                    }
                    unset($image->$fileKey);
                }
            }
        }

        // Update the model instance with new file paths
        foreach ($newFiles as $fileKey => $paths) {
            $image->$fileKey = json_encode(array_values($paths));
        }

        if (!$image->isDirty()) {
            return response()->json([
                'message' => 'No changes detected.',
            ], 304);
        }

        if (!$image) {
            $image->save();
        } else {
            $image->save();
        }

        return response()->json([
            'message' => 'Update successful',
            'updated_files' => $newFiles,
        ], 200);
    }
}
