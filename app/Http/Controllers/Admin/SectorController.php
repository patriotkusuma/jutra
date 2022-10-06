<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DataTables;

class SectorController extends Controller
{
    public function index(Request $request){
        // $response = Http::get('https://www.pasardana.id/api/StockNewSector/GetAll');
        // $response = Http::get('https://www.pasardana.id/api/StockSector/GetAll');
        // $response = Http::get('https://www.pasardana.id/api/StockSubSector/GetSubSectorFromSector');
        if($request->ajax()){
            $response = Http::get('https://www.pasardana.id/api/StockSearchResult/GetAll?pageBegin=0&pageLength=1000&sortField=Code&sortOrder=ASC');
            if($response->status() == '200'){
                $data = json_decode($response->getBody()->getContents());
            }

        }

        return view('pages.daily.index');

    }
}
