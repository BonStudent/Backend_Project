<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Images;

class ImagesController extends Controller
{
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id_reference' => 'required|integer',
            'img' => 'array',
            'img.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $id_reference = $validatedData['id_reference'];

        $imageRecord = Images::firstOrNew(['id_reference' => $id_reference]);

        $imgKeys = ['img1', 'img2', 'img3', 'img4', 'img5','img6', 'img7', 'img8', 'img9', 'img10'];
        $newImages = [];

        foreach ($imgKeys as $imgKey) {
            if ($request->hasFile($imgKey)) {
                // Delete old files if they exist
                $oldFilePaths = json_decode($upload->$imgKey, true) ?? [];
                foreach ($oldFilePaths as $oldPath) {
                    if (Storage::disk('public')->exists("MandatoryRequirements/{$imgKey}/{$oldPath}")) {
                        Storage::disk('public')->delete("MandatoryRequirements/{$imgKey}/{$oldPath}");
                    }
                }
    
                // Store new files
                $uploadedPaths = [];
                foreach ($request->file($imgKey) as $img) {
                    $originalName = time() . '-' . $img->getClientOriginalName();
                    $path = $img->storeAs("public/MandatoryRequirements/{$imgKey}", $originalName);
                    $uploadedPaths[] = basename($path);
                }
    
                $newImages[$imgKey] = $uploadedPaths;
            }
        }

        // Update the database with new image paths
        foreach ($newImages as $key => $paths) {
            $imageRecord->$key = json_encode($paths);
        }

        // Save changes to the database
        if ($imageRecord->isDirty()) {
            $imageRecord->save();
            return response()->json([
                'message' => 'Update successful',
                'updated_files' => $newImages,
            ], 200);
        }

        return response()->json([
            'message' => 'No changes detected.',
        ], 304);
    }
}
