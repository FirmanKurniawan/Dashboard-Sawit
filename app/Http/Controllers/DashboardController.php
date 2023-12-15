<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function data()
    {
        $datas = Data::orderBy('time', 'ASC')->get();

        $extractedData = [];

        foreach ($datas as $data) {
            $dataValues = explode(',', str_replace(['(', ')'], '', $data->data));

            $area = trim($dataValues[0], ' "');
            $beratTBS = (int) trim($dataValues[1], ' "');
            $status = trim($dataValues[2], ' "');
            $idTruck = trim($dataValues[3], ' "');

            $extractedData[] = [
                'id' => $data->id,
                'time' => $data->time,
                'area' => $area,
                'beratTBS' => $beratTBS,
                'status' => $status,
                'idTruck' => $idTruck,
            ];

            $data->area = $area;
            $data->beratTBS = $beratTBS;
            $data->status = $status;
            $data->idTruck = $idTruck;
        }

        return view('dashboard.data', compact('datas', 'extractedData'));
    }
}
