<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Images;
use Illuminate\Support\Str; // Import the Str class for UUID generation

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
                $oldFilePaths = json_decode($imageRecord->$imgKey, true) ?? [];
                foreach ($oldFilePaths as $oldPath) {
                    if (Storage::disk('public')->exists("Images/{$imgKey}/{$oldPath}")) {
                        Storage::disk('public')->delete("Images/{$imgKey}/{$oldPath}");
                    }
                }
    
                // Store new files
                $uploadedPaths = [];
                foreach ($request->file($imgKey) as $img) {
                    $originalName = time() . '-' . $img->getClientOriginalName();
                    $path = $img->storeAs("public/Images/{$imgKey}", $originalName);
                    $uploadedPaths[] = basename($path);
                }
    
                $newImages[$imgKey] = $uploadedPaths;
            }
        }

        // Update the database with new image paths
        foreach ($newImages as $imgkey => $paths) {
            $imageRecord->$imgkey = json_encode($paths);
        }

        $imageRecord->save();
    
        return response()->json([
            'message' => 'Update successful',
            'updated_images' => $newImages,
        ], 200);
    }
}
