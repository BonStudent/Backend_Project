<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uploads;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    public function create(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'id_reference' => 'required',
            'filename' => 'nullable|mimes:pdf,doc,docx|max:2048', // Use files.* to validate each file in the array
        ]);

        if ($request->hasFile('filename') && $request->has('id_reference')) {
            $files = $data['filename'];
            $id_reference = $data['id_reference'];

            // dd($request->file('filename'));

            foreach ($files as $file) {
                if ($file->isValid()) {
                    $fileName = uniqid() . "_" . $file->getClientOriginalName(); // Get the original filename

                    // Store the file to the desired location
                    // $filePath = storage_path('app/public/uploads/');
                    // $file->move($filePath, $fileName);

                    $path = $file->storeAs('public', $fileName);

                    // Save file information to the database
                    $upload = new Uploads();
                    $upload->id_reference = $id_reference;
                    $upload->filename = $path;
                    $upload->save();
                } else {
                    return response()->json(['message' => 'Invalid file'], 400);
                }
            }
            return response()->json(['message' => 'Records created successfully'], 201);
        } else {
            return response()->json(['message' => 'No files or id_reference provided'], 400);
        }
    }
}
