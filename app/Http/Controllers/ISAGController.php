<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ISAG;

class ISAGController extends Controller
{
    public function index()
    {
        return response()->json(ISAG::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city_municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'sitio' => 'nullable|string|max:255',
            'river' => 'required|string|max:255',
            'received' => 'required|date',
            'released' => 'required|date',
            'status' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $isag = ISAG::create($validated);
        return response()->json($isag, 201);
    }
}