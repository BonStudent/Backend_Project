<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;

class AccountsController extends Controller
{
    //
    public function create(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Create a new Details model instance and fill it with request data
        $accounts = new accounts();
        $accounts->fill($request->all());
        $accounts->save();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record created successfully'], 201);
    }

    // Method to update an existing record
    public function update(Request $request, $id)
    {
        // Find the record by ID
        $accounts = Accounts::findOrFail($id);

        // Validate incoming request data
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Update the record with the new data
        $accounts->update($request->all());

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Record updated successfully'], 200);
    }

    public function currentUser(Request $request)
    {
        $user = $request->user(); // Retrieve current authenticated user
        return response()->json(['username' => $user->username]);
    }
}
