<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QUARRY;

class QUARRYController extends Controller
{
    public function index()
    {
        return response()->json(QUARRY::all(), 200);
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
            'lot_no' => 'required|string|max:255',
            'survey_no' => 'required|string|max:255',
            'received' => 'required|date',
            'released' => 'required|date',
            'status' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $quarry = QUARRY::create($validated);
        return response()->json($quarry, 201);
    }
}