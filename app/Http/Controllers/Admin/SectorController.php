<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SectorController extends Controller
{
    public function index(Request $request){
        // $response = Http::get('https://www.pasardana.id/api/StockNewSector/GetAll');
        // $response = Http::get('https://www.pasardana.id/api/StockSector/GetAll');
        $response = Http::get('https://www.pasardana.id/api/StockSubSector/GetSubSectorFromSector');

        if($response->status() == '200'){
            $data = json_decode($response->getBody()->getContents());
            dd($data);
        }
        dd($response->status());
    }
}
