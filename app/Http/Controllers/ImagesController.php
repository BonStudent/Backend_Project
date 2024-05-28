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
            'images1.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images2.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images3.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images4.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images5.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images6.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images7.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images8.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images9.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images10.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images11.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images12.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images13.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images14.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images15.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images16.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images17.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images18.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images19.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'images20.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
        ]);

        $filePaths = [];

        // Process each file input
        for ($i = 1; $i <= 20; $i++) {
            $fileKey = 'images' . $i;

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
                'images1.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images2.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images3.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images4.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images5.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images6.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images7.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images8.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images9.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images10.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images11.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images12.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images13.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images14.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images15.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images16.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images17.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images18.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images19.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
                'images20.*' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            ])
        ], 201);
    }


}
