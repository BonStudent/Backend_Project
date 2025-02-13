<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Images;

class ImagesController extends Controller
{
    public function update(Request $request)
    {
        // Extract id_reference from the request
        $id_reference = $request->input('id_reference');

        // Validate the uploaded images
        $request->validate([
            'img1.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'img2.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'img3.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'img4.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'img5.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'img6.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'img7.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'img7.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'img9.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'img10.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Find or create the Images record
        $imageRecord = Images::firstOrNew(['id_reference' => $id_reference]);

        $imgKeys = ['img1', 'img2', 'img3', 'img4', 'img5','img6', 'img7', 'img8', 'img9', 'img10'];
        $newImages = [];

        foreach ($imgKeys as $imgKey) {
            if ($request->hasFile($imgKey)) {
                // Delete old images
                if (!empty($imageRecord->$imgKey)) {
                    $oldimgPaths = json_decode($imageRecord->$imgKey, true);
                    foreach ($oldimgPaths as $oldPath) {
                        Storage::disk('public')->delete("Images/{$imgKey}/{$oldPath}");
                    }
                }

                // Save new images
                $uploadedPaths = [];
                foreach ($request->file($imgKey) as $img) {
                    $originalName = time() . '-' . $img->getClientOriginalName(); // Add timestamp to avoid conflicts
                    $path = $img->storeAs("Images/{$imgKey}", $originalName, 'public');
                    $uploadedPaths[] = $originalName;
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
