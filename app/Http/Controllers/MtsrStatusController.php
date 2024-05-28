<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MtsrStatus;

class MtsrStatusController extends Controller
{
    // Method to create a new record
    public function create(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'id_reference' => 'required',
            'mtsr' => 'required',
            'overallstatus' => 'required',
        ]);

        // Create a new mtsr model instance and fill it with request data
        $mtsr = new MtsrStatus();
        $mtsr->fill($request->all());
        $mtsr->save();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record created successfully'], 201);
    }
     // Method to update an existing record
public function update(Request $request)
{
    $id_reference = $request->input('id_reference');
    // Try to find the record by id_reference
    $mtsr = MtsrStatus::where('id_reference', $id_reference)->first();
    

    // If the recommendation exists, update it
    if ($mtsr) {
        // Validate incoming request data
        $validatedData = $request->validate([
            'id_reference' => 'required',
            'mtsr' => 'nullable',
            'overallstatus' => 'nullable',
        ]);
        // Convert empty strings to NULL
        foreach ($validatedData as $key => $value) {
            if ($value === '') {
                $validatedData[$key] = null;
            }
        }

        // Update the recommendation with the new data
        $mtsr->update($validatedData);

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record updated successfully'], 200);
    } else {
        // If the recommendation does not exist, create a new one
        // Create a new recommendation instance
        $newMtsr = new MtsrStatus();
        // Set the id_reference
        $newMtsr->id_reference = $id_reference;

        // Validate incoming request data
        $validatedData = $request->validate([
            'id_reference' => 'required',
            'mtsr' => 'nullable',
            'overallstatus' => 'nullable',
        ]);
        // Convert empty strings to NULL
        foreach ($validatedData as $key => $value) {
            if ($value === '') {
                $validatedData[$key] = null;
            }
        }

        // Fill the new recommendation with the validated data
        $newMtsr->fill($validatedData);
        // Save the new recommendation
        $newMtsr->save();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'New record created successfully'], 200);
    }
}

    
}
