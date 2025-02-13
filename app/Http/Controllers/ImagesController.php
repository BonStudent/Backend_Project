<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImagesController extends Controller
{
    public function update(Request $request, $id_reference)
{
    $request->validate([
        'img1.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'img2.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'img3.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'img4.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'img5.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'img6.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'img7.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'img8.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'img9.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'img10.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    DB::beginTransaction();
    try {
        // Retrieve the existing image record for the given reference ID
        $imageRecord = Images::where('id_reference', $id_reference)->first();

        if (!$imageRecord) {
            // If no record exists, create a new one
            $imageRecord = new Images();
            $imageRecord->id_reference = $id_reference;
        }

        for ($i = 1; $i <= 10; $i++) {
            $imgKey = "img{$i}";

            if ($request->hasFile($imgKey)) {
                $uploadedFiles = [];

                foreach ($request->file($imgKey) as $file) {
                    $path = $file->store('uploads/images', 'public');
                    $uploadedFiles[] = $path;
                }

                // Convert array to JSON and store it in the database
                $imageRecord->$imgKey = json_encode($uploadedFiles);
            }
        }

        // Save the updated record
        $imageRecord->save();
        DB::commit();

        return response()->json([
            'message' => 'Images updated successfully!',
            'images' => $imageRecord
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Image update failed', 'error' => $e->getMessage()], 500);
    }
}
    public function getImages($id_reference)
    {
        $images = Image::where('reference_id', $id_reference)->get();

        return response()->json([
            'message' => 'Images retrieved successfully!',
            'images' => $images
        ]);
    }
}
