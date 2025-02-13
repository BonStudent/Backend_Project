<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Details;

class DetailsController extends Controller
{
    // Method to create a new record
    public function create(Request $request)
    {
        // Log the received data to check what is being sent from Vue.js
    \Log::info('Received data:', $request->all());
        // Validate incoming request data
        $request->validate([
            'stage_of_processing' => 'required',
            'status' => 'required',
            'tenement_name' => 'required',
            'date_filed' => 'required|date',
            'barangay' => 'nullable',
            'barangay1' => 'nullable',
            'barangay2' => 'nullable',
            'barangay3' => 'nullable',
            'area_hectares' => 'required',
            'area_hectares1' => 'nullable',
            'area_hectares2' => 'nullable',
            'area_hectares3' => 'nullable',
            'city' => 'nullable',
            'city1' => 'nullable',
            'city2' => 'nullable',
            'city3' => 'nullable',
            'province' => 'nullable',
            'province1' => 'nullable',
            'province2' => 'nullable',
            'province3' => 'nullable',
            'commodity' => 'required',
            'authorized_rep' => 'required',
            'category' => 'required',
            'contact_no' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'others' => 'nullable',
            'application' => 'required',
        ]);
    
        // Process dynamic location fields
        $barangays = [
            $request->barangay,
            $request->barangay1,
            $request->barangay2,
            $request->barangay3
        ];
    
        $cities = [
            $request->city,
            $request->city1,
            $request->city2,
            $request->city3
        ];
    
        $provinces = [
            $request->province,
            $request->province1,
            $request->province2,
            $request->province3
        ];
    
        // Filter out null or empty values
        $barangays = array_filter($barangays, fn($value) => !empty($value));
        $cities = array_filter($cities, fn($value) => !empty($value));
        $provinces = array_filter($provinces, fn($value) => !empty($value));
    
        // Create a new Details model instance and fill it with request data
        $details = new Details();
        $details->fill($request->except([
            'barangay', 'barangay1', 'barangay2', 'barangay3',
            'city', 'city1', 'city2', 'city3',
            'province', 'province1', 'province2', 'province3'
        ]));
    
        // Save each location field
        $details->barangay = $barangays[0] ?? null;
        $details->barangay1 = $barangays[1] ?? null;
        $details->barangay2 = $barangays[2] ?? null;
        $details->barangay3 = $barangays[3] ?? null;
    
        $details->city = $cities[0] ?? null;
        $details->city1 = $cities[1] ?? null;
        $details->city2 = $cities[2] ?? null;
        $details->city3 = $cities[3] ?? null;
    
        $details->province = $provinces[0] ?? null;
        $details->province1 = $provinces[1] ?? null;
        $details->province2 = $provinces[2] ?? null;
        $details->province3 = $provinces[3] ?? null;
    
        // Save the record
        $details->save();
    
        // Optionally, return a response indicating success
        return response()->json(['message' => 'Record created successfully', 'data' => $details], 201);
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
            'area_hectares1' => 'nullable',
            'area_hectares2' => 'nullable',
            'area_hectares3' => 'nullable',
            'date_filed' => 'nullable',
            'barangay' => 'nullable',
            'barangay1' => 'nullable',
            'barangay2' => 'nullable',
            'barangay3' => 'nullable',
            'city' => 'nullable',
            'city1' => 'nullable',
            'city2' => 'nullable',
            'city3' => 'nullable',
            'province' => 'nullable',
            'province1' => 'nullable',
            'province2' => 'nullable',
            'province3' => 'nullable',   
            'commodity' => 'nullable',
            'authorized_rep' => 'nullable',
            'category' => 'nullable',
            'contact_no' => 'nullable',
            'email' => 'nullable',
            'address' => 'nullable',
            'oth_rs' => 'nullable',
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
    // Method to get a specific record by ID
    public function getDetailsById($id)
    {
        // Find the record by ID
        $details = Details::find($id);
    
        // Check if the record exists
        if (!$details) {
            return response()->json(['message' => 'Record not found'], 404);
        }
    
        // Return the retrieved record as JSON
        return response()->json($details);
    }

    // Method to update the status of a specific detail
    public function updateStatus(Request $request)
    {
        try {
            // Validate incoming request data
            $request->validate([
                'id' => 'nullable',
                'status' => 'required|string|max:1000', // Validate the status field
                'stage_of_processing' => 'nullable|string|max:1000', // Validate the stage_of_processing field
            ]);

            // Find the record by ID
            $details = Details::findOrFail($request->id);

            // Update the status and stage_of_processing fields
            $details->update([
                'status' => $request->status,
                'stage_of_processing' => $request->stage_of_processing,
            ]);

            return response()->json(['message' => 'Status updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status', 'exception' => $e->getMessage()], 500);
        }
    }
}
