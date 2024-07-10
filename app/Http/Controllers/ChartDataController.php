<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChartData;

class ChartDataController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|string',
            'barData' => 'required|string',
            'pieData' => 'required|string',
        ]);

        try {
            $chartData = ChartData::updateOrCreate(
                ['year' => $validated['year']],
                [
                    'bar_data' => $validated['barData'],
                    'pie_data' => $validated['pieData']
                ]
            );

            return response()->json(['message' => 'Chart data updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update chart data'], 500);
        }
    }

    public function fetch($year)
    {
        try {
            $chartData = ChartData::where('year', $year)->firstOrFail();

            return response()->json([
                'year' => $chartData->year,
                'barData' => explode(',', $chartData->bar_data),
                'pieData' => explode(',', $chartData->pie_data),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Chart data not found'], 404);
        }
    }

    public function fetchLatest()
    {
        try {
            $chartData = ChartData::orderBy('year', 'desc')->firstOrFail();

            return response()->json([
                'year' => $chartData->year,
                'barData' => explode(',', $chartData->bar_data),
                'pieData' => explode(',', $chartData->pie_data),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Chart data not found'], 404);
        }
    }
}