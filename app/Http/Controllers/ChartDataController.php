<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChartData;
use Illuminate\Support\Facades\Log;

class ChartDataController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|string',
            'barData' => 'required|string',
            'pieData' => 'required|string',
        ]);

        Log::info('Update request received', $validated);

        try {
            $chartData = ChartData::updateOrCreate(
                ['year' => $validated['year']],
                [
                    'bar_data' => $validated['barData'],
                    'pie_data' => $validated['pieData']
                ]
            );

            Log::info('Chart data updated', ['chartData' => $chartData]);

            return response()->json(['message' => 'Chart data updated successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to update chart data', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to update chart data'], 500);
        }
    }

    public function fetch($year)
    {
        Log::info('Fetch request received for year: ' . $year);

        try {
            $chartData = ChartData::where('year', $year)->firstOrFail();

            Log::info('Chart data fetched', ['chartData' => $chartData]);

            return response()->json([
                'year' => $chartData->year,
                'barData' => explode(',', $chartData->bar_data),
                'pieData' => explode(',', $chartData->pie_data),
            ]);
        } catch (\Exception $e) {
            Log::error('Chart data not found', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Chart data not found'], 404);
        }
    }

    public function fetchLatest()
    {
        Log::info('Fetch latest request received');

        try {
            $chartData = ChartData::orderBy('year', 'desc')->firstOrFail();

            Log::info('Latest chart data fetched', ['chartData' => $chartData]);

            return response()->json([
                'year' => $chartData->year,
                'barData' => explode(',', $chartData->bar_data),
                'pieData' => explode(',', $chartData->pie_data),
            ]);
        } catch (\Exception $e) {
            Log::error('Chart data not found', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Chart data not found'], 404);
        }
    }
}