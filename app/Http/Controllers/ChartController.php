<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NewsPost;
use App\Models\Tag;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;


use Illuminate\Http\Request;

class ChartController extends Controller
{

    private static function buildChart($name,$label,$labels,$data,$start) {
        $chart = Chartjs::build()
            ->name($name)
            ->type("line")
            ->size(["width" => 400, "height" => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => $label,
                    "backgroundColor" => "rgba(126, 34, 206,0.31)",
                    "borderColor" => "rgba(88, 28, 135, 0.7)",
                    "data" => $data
                ]
            ])
            ->options([
                'scales' => [
                    'x' => [
                        'type' => 'time',
                        'time' => [
                            'unit' => 'month'
                        ],
                        'min' => $start->format("Y-m-d"),
                    ]
                ],
            ]);
        return $chart;
    }

    public static function usersChart()
    {
    
        $start = Carbon::parse(User::min("created_at"));
        $end = Carbon::now();
        $period = CarbonPeriod::create($start, "1 month", $end);

        $usersPerMonth = collect($period)->map(function ($date) {
            $startDate = $date->copy()->startOfMonth();
            $endDate   = $date->copy()->endOfMonth();

            return [
                "count" => User::whereBetween("created_at", [$startDate,$endDate])->count(),
                "month" => $endDate->format("Y-m-d")
            ];
        });

        $data = $usersPerMonth->pluck("count")->toArray();
        $labels = $usersPerMonth->pluck("month")->toArray();

        return self::buildChart("UserRegistration","User Registration",$labels,$data,$start);
    }
    public static function newsChart()
    {
    
        $start = Carbon::parse(NewsPost::min("created_at"));
        $end = Carbon::now();
        $period = CarbonPeriod::create($start, "1 month", $end);

        $newsPerMonth = collect($period)->map(function ($date) {
            $startDate = $date->copy()->startOfMonth();
            $endDate   = $date->copy()->endOfMonth();

            return [
                "count" => NewsPost::whereBetween("created_at", [$startDate,$endDate])->count(),
                "month" => $endDate->format("Y-m-d")
            ];
        });

        $data = $newsPerMonth->pluck("count")->toArray();
        $labels = $newsPerMonth->pluck("month")->toArray();

        return self::buildChart("NewsPostCreation","News Post Creation",$labels,$data,$start);
    }
}