<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChartData;
use Illuminate\Support\Facades\Log;

class ChartDataController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->only(['year', 'barData', 'pieData']);
        
        try {
            $chartData = ChartData::where('year', $data['year'])->first();

            if (!$chartData) {
                $chartData = new ChartData();
                $chartData->year = $data['year'];
            }

            $chartData->bar_data = $data['barData'];
            $chartData->pie_data = $data['pieData'];
            $chartData->save();

            return response()->json(['message' => 'Chart data updated successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to update chart data: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update chart data'], 500);
        }
    }

    public function fetch($year)
    {
        try {
            $chartData = ChartData::where('year', $year)->first();

            if (!$chartData) {
                return response()->json(['message' => 'Chart data not found for year ' . $year], 404);
            }

            return response()->json([
                'year' => $chartData->year,
                'barData' => explode(',', $chartData->bar_data),
                'pieData' => explode(',', $chartData->pie_data),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch chart data: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to fetch chart data'], 500);
        }
    }

    public function fetchLatest()
    {
        try {
            $latestData = ChartData::latest()->first();

            if (!$latestData) {
                return response()->json(['message' => 'No chart data found'], 404);
            }

            return response()->json([
                'year' => $latestData->year,
                'barData' => explode(',', $latestData->bar_data),
                'pieData' => explode(',', $latestData->pie_data),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch latest chart data: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to fetch latest chart data'], 500);
        }
    }
}