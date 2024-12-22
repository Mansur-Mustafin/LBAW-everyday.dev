<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class ChartController extends Controller
{
    private static function buildChart($name, $label, $labels, $data, $start)
    {
        $chart = Chartjs::build()
            ->name($name)
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    'label' => $label,
                    'backgroundColor' => 'rgba(126, 34, 206, 0.31)',
                    'borderColor' => 'rgba(88, 28, 135, 0.7)',
                    'data' => $data
                ]
            ])
            ->options([
                'plugins' => [
                    'legend' => [
                        'labels' => [
                            'color' => 'rgba(236, 236, 236, 1)'
                        ]
                    ],
                ],
                'scales' => [
                    'x' => [
                        'type' => 'time',
                        'time' => [
                            'unit' => 'month'
                        ],
                        'min' => $start->format('Y-m-d'),
                        'ticks' => [
                            'color' => 'rgba(236, 236, 236, 1)',
                        ]
                    ],
                    'y' => [
                        'ticks' => [
                            'color' => 'rgba(236, 236, 236, 1)'
                        ]
                    ]
                ],
            ]);
        return $chart;
    }

    private static function generateChartData(string $modelClass): array
    {
        $start = Carbon::parse($modelClass::min('created_at'));
        $end = Carbon::now();
        $period = CarbonPeriod::create($start, '1 month', $end);

        $data = collect($period)->map(function ($date) use ($modelClass) {
            $startDate = $date->copy()->startOfMonth();
            $endDate = $date->copy()->endOfMonth();

            return [
                'count' => $modelClass::whereBetween('created_at', [$startDate, $endDate])->count(),
                'month' => $endDate->format('Y-m-d'),
            ];
        });

        return [
            'start' => $start,
            'data' => $data->pluck('count')->toArray(),
            'labels' => $data->pluck('month')->toArray(),
        ];
    }

    public static function usersChart()
    {
        $chartData = self::generateChartData(User::class);

        return self::buildChart(
            'UserRegistration',
            'User Registration',
            $chartData['labels'],
            $chartData['data'],
            $chartData['start']
        );
    }

    public static function newsChart()
    {
        $chartData = self::generateChartData(NewsPost::class);

        return self::buildChart(
            'NewsPostCreation',
            'News Post Creation',
            $chartData['labels'],
            $chartData['data'],
            $chartData['start']
        );
    }
}
