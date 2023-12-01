<?php

namespace App\Charts;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TotalPenjualanPetaniChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($userId): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $data = $this->getDataForChart($userId);

        return $this->chart->lineChart()
            ->setTitle('Data Penjualan')
            ->setSubtitle('Total transaksi setiap bulan')
            ->addData('Total Penjualan', $data['price'])
            ->setColors(['#ffc63b'])
            ->setXAxis($data['months']);
    }

    protected function getDataForChart($userId)
    {
        $query = Transaction::select(
            DB::raw('SUM(many) as total_many'),
            DB::raw('SUM(price) as total_price'),
            DB::raw("TO_CHAR(date, 'Month YYYY') as month_year")
        )
        ->groupBy('month_year');

        if ($userId !== null) {
            $query->where('user_id', $userId);
        }

        $result = $query->get();

        $data = [
            'many' => [],
            'price' => [],
            'months' => [],
        ];

        foreach ($result as $row) {
            $data['many'][] = $row->total_many;
            $data['price'][] = $row->total_price;
            $data['months'][] = $row->month_year;
        }

        return $data;
    }
}
