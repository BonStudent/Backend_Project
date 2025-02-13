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
        'img.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    \Log::info('Validation Passed:', ['data' => $validatedData]);

    $id_reference = $validatedData['id_reference'];
    $imgKeys = ['img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8', 'img9', 'img10'];
    $newImages = [];

    // Find the record or create a new one
    $imageRecord = Images::firstOrNew(['id_reference' => $id_reference]);

    foreach ($imgKeys as $imgKey) {
        if ($request->hasFile($imgKey)) {
            \Log::info("File detected for: " . $imgKey);

            // Get existing images (if any)
            $oldFilePaths = explode(',', $imageRecord->$imgKey) ?? [];

            // Delete old files
            foreach ($oldFilePaths as $oldPath) {
                if (Storage::disk('public')->exists("Images/{$imgKey}/{$oldPath}")) {
                    Storage::disk('public')->delete("Images/{$imgKey}/{$oldPath}");
                }
            }

            // Store new files
            $uploadedPaths = [];
            $files = $request->file($imgKey); // This should be an array of files

            // Check if $files is an array
            if (is_array($files)) {
                foreach ($files as $file) {
                    $originalName = time() . '-' . $file->getClientOriginalName();
                    $file->storeAs("public/Images/{$imgKey}", $originalName);
                    $uploadedPaths[] = $originalName; // Store the file name
                }
            } else {
                // Handle single file upload
                $originalName = time() . '-' . $files->getClientOriginalName();
                $files->storeAs("public/Images/{$imgKey}", $originalName);
                $uploadedPaths[] = $originalName; // Store the file name
            }

            // Store the new images as a comma-separated string
            $newImages[$imgKey] = implode(',', array_merge($oldFilePaths, $uploadedPaths));
        } else {
            \Log::info("No file found for: " . $imgKey);
        }
    }

    // Log new images before saving
    \Log::info('New images before fill:', ['new_images' => $newImages]);

    // Fill the model with new image paths
    $imageRecord->fill(array_merge($newImages, ['id_reference' => $id_reference]));

    // Attempt to save the record
    try {
        if (!$imageRecord->save()) {
            \Log::error('Failed to save!', ['errors' => $imageRecord->getErrors()]);
            return response()->json(['error' => 'Failed to save image record.'], 422);
        }
    } catch (\Exception $e) {
        \Log::error('Exception occurred while saving:', ['message' => $e->getMessage()]);
        return response()->json(['error' => 'An error occurred while saving.'], 500);
    }

    return response()->json(['success' => 'Images uploaded successfully.']);
}


}
