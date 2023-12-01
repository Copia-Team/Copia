<?php

namespace App\Charts;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TotalPenjualanSemuaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $data = DB::table('transactions')
            ->join('products', 'transactions.product_id', '=', 'products.id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->select(DB::raw('SUM(transactions.many) as total'), 'stores.name as store_name', 'transactions.date')
            ->groupBy('stores.name', 'transactions.date')
            ->orderBy('transactions.date')
            ->get();

        $chartData = [];
        $storeNames = [];
        $dateLabels = [];

        foreach ($data as $entry) {
            $storeName = $entry->store_name;
            $date = Carbon::parse($entry->date)->format('F Y');

            if (!in_array($storeName, $storeNames)) {
                $storeNames[] = $storeName;
            }

            if (!in_array($date, $dateLabels)) {
                $dateLabels[] = $date;
            }

            $chartData[$storeName][$date] = $entry->total;
        }

        $datasets = [];
        foreach ($storeNames as $storeName) {
            $dataset = [
                'name' => $storeName,
                'data' => array_values($chartData[$storeName] ?? array_fill_keys($dateLabels, 0)),
            ];

            $datasets[] = $dataset;
        }

        return $this->chart->barChart()
            ->setTitle('Grafik Penjualan Jagung(kg)')
            ->setSubtitle('Perbulan')
            ->setXAxis($dateLabels)
            ->setDataset($datasets)
            ->setLabels($storeNames);
    }
}
