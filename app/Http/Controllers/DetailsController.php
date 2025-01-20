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
            'stage_of_processing' => 'nullable',
            'application' => 'required',
            'comments' => 'nullable',
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
            'stage_of_processing' => 'nullable',
            'application' => 'nullable',
            'comments' => 'nullable',
        ]);

        // Update the record with the new data
        $details->update($request->all());

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record updated successfully'], 200);
    }

    public function getDetails($id)
    {
        try {
            $detail = Details::find($id);

            if (!$detail) {
                return response()->json(['message' => 'Detail not found'], 404);
            }

            return response()->json($detail, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching details', 'error' => $e->getMessage()], 500);
        }
    }

    // Method to update the comment of a specific detail
public function updateComment(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'detail_id' => 'required|exists:details,id', // Ensure detail_id exists in the database
        'comments' => 'required|string|max:1000', // Validate the comment field
    ]);

    try {
        // Find the record by ID
        $details = Details::findOrFail($request->detail_id);

        // Update only the comment field
        $details->update([
            'comments' => $request->comments,
        ]);

        // Return a success response
        return response()->json(['message' => 'Comment updated successfully'], 200);
    } catch (\Exception $e) {
        // Handle any errors
        return response()->json(['error' => 'Failed to update comment'], 500);
    }
}

// DetailController.php
public function destroy($id)
{
    $detail = Detail::find($id);
    if ($detail) {
        $detail->delete();
        return response()->json(['message' => 'Detail deleted successfully'], 200);
    } else {
        return response()->json(['message' => 'Detail not found'], 404);
    }
}
}
