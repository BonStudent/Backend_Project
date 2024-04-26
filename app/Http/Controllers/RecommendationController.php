<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommendation;

class RecommendationController extends Controller
{
    // Method to create a new record
    public function create(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'id_reference' => 'required',
            'input1' => 'nullable',
            'input2' => 'nullable',
            'input3' => 'nullable',
            'input4' => 'nullable',
            'input5' => 'nullable',
            'input6' => 'nullable',
            'input7' => 'nullable',
            'input8' => 'nullable',
            'input9' => 'nullable',
            'input10' => 'nullable',
            'input11' => 'nullable',
            'input12' => 'nullable',
            'input13' => 'nullable',
            'input14' => 'nullable',
            'input15' => 'nullable',
            'input16' => 'nullable',
            'input17' => 'nullable',
        ]);

        // Create a new Details model instance and fill it with request data
        $recommendation = new Recommendation();
        $recommendation->fill($request->all());
        $recommendation->save();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record created successfully'], 201);
    }

    // Method to update an existing record
    public function update(Request $request, $id)
    {
        // Find the record by ID
        $recommendation = Recommendation::findOrFail($id);
        // Validate incoming request data
        $request->validate([
            'id_reference' => 'required',
            'input1' => 'nullable',
            'input2' => 'nullable',
            'input3' => 'nullable',
            'input4' => 'nullable',
            'input5' => 'nullable',
            'input6' => 'nullable',
            'input7' => 'nullable',
            'input8' => 'nullable',
            'input9' => 'nullable',
            'input10' => 'nullable',
            'input11' => 'nullable',
            'input12' => 'nullable',
            'input13' => 'nullable',
            'input14' => 'nullable',
            'input15' => 'nullable',
            'input16' => 'nullable',
            'input17' => 'nullable',
        ]);

        // Update the record with the new data
        $recommendation->update($request->all());

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record updated successfully'], 200);
    }
}
