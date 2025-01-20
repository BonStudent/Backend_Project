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
            'stage_of_processing' => 'required',
            'stage_of_processing_details' => 'nullable',
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
            'stage_of_processing' => 'nullable',
            'stage_of_processing_details' => 'nullable',
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

    // Method to delete an existing record
    public function delete($id)
    {
        // Find the record by ID
        $details = Details::findOrFail($id);

        // Delete the record
        $details->delete();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
    // Method to update the comment of a specific detail
    public function updateComment(Request $request, )
    {
        try {
            // Validate incoming request data
            $request->validate([
                'id' => 'required', // Ensure detail_id exists in the database
                'comments' => 'required|string|max:1000', // Validate the comment field
            ]);

            // Find the record by ID
            $details = Details::findOrFail($request->id);

            // Update only the comment field
            $details->update([
                'comments' => $request->comments,
            ]);

            return response()->json(['message' => 'Comment updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update comment', 'exception' => $e->getMessage()], 500);
        }
    }
}
