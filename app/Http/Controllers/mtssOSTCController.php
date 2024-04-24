<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mtssOSTC;

class mtssOSTCController extends Controller
{
    // Method to create a new record
    public function create(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'client' => 'required',
            'certnum' => 'required',
            'dateReceivedByORD' => 'required',
            'dateReceivedByMMD' => 'required',
            'PaymentDate' => 'required',
            'sampleInspection' => 'required',
            'dateIssued' => 'required',
            'MMDPersonnel' => 'required',
            'ProofOfMOV' =>'required',
        ]);

        // Create a new Details model instance and fill it with request data
        $mtssOSTC = new mtssOSTC();
        $mtssOSTC->fill($request->all());
        $mtssOSTC->save();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record created successfully'], 201);
    }

    // Method to update an existing record
    public function update(Request $request, $id)
    {
        // Find the record by ID
        $mtssOSTC = Details::findOrFail($id);

        // Validate incoming request data
        $request->validate([
            'client' => 'required',
            'certnum' => 'required',
            'dateReceivedByORD' => 'required',
            'dateReceivedByMMD' => 'required',
            'PaymentDate' => 'required',
            'sampleInspection' => 'required',
            'dateIssued' => 'required',
            'MMDPersonnel' => 'required',
            'ProofOfMOV' =>'required',
        ]);

        // Update the record with the new data
        $mtssOSTC->update($request->all());

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record updated successfully'], 200);
    }
}
