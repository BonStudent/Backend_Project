<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Details;

class DetailsController extends Controller
{
    // Method to create a new record
    public function create(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'status' => 'required',
            'tenement_number' => 'required',
            'tenement_name' => 'required',
            'area_hectares' => 'required',
            'date_filed' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'province' => 'required',
            'commodity' => 'required',
            'authorized_rep' => 'required',
            'category' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'others' => 'required',
            'application' => 'required',
        ]);

        // Create a new Details model instance and fill it with request data
        $details = new Details();
        $details->fill($request->all());
        $details->save();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record created successfully'], 201);
    }

    // Method to update an existing record
    public function update(Request $request, $id)
    {
        // Find the record by ID
        $details = Details::findOrFail($id);
        // Validate incoming request data
        $request->validate([
            'status' => 'nullable',
            'tenement_number' => 'nullable',
            'tenement_name' => 'nullable',
            'area_hectares' => 'nullable',
            'date_filed' => 'required',
            'barangay' => 'nullable',
            'city' => 'nullable',
            'province' => 'nullable',
            'commodity' => 'nullable',
            'authorized_rep' => 'nullable',
            'category' => 'nullable',
            'contact_no' => 'nullable',
            'email' => 'nullable',
            'others' => 'nullable',
            'application' => 'nullable',
        ]);

        // Update the record with the new data
        $details->update($request->all());

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record updated successfully'], 200);
    }
}
