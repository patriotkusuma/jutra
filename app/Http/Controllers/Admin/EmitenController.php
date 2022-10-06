<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emiten;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class EmitenController extends Controller
{
    public function index(Request $request){
        $emitens = Emiten::orderBy('code')->paginate(10);

        // $getStock = Http::get('https://www.pasardana.id/api/StockSearchResult/GetAll?pageBegin=0&pageLength=1000&sortField=Code&sortOrder=ASC');
        // $getStock = Http::get('https://cuaca-gempa-rest-api.vercel.app/');
        // dd(json_decode($getStock->getBody()->getContents()));
        return view('pages.emiten.index',compact('emitens'));
    }

    public function add(Request $request){
        // $path = asset('/storage/emiten/y6QSguTVsGYcsOVk1d6ZMy1bZ2ZdghguQ7GOnDoM.json');
        // $json = json_decode(file_get_contents($path),true);
        // dd($json);
        // $file = file_get_contents();
        // dd($file);
        // if($request->hasFile('emiten')){
        //     // dd($request->hasFile('emiten'));
        //     $path = $request->emiten->store('/emiten');
        //     $jsonFile =  asset('/storage/'.$path);
        //     $path = json_decode(file_get_contents($jsonFile),true);
        //     dd($path);
        //     return $request;
        // }

        if($request->has('name')){
            $request->validate([
                'name' => 'required',
                'code' => 'required|unique:emiten,code',
                'listing_date' => 'required|date',
                'shares' => 'required',
                'listing_board' => 'required'
            ]);

            $emiten = Emiten::create([
                'name' => $request->name,
                'code' => $request->code,
                'listing_date' => Carbon::parse($request->listing_date)->toDateTime(),
                'shares' => $request->shares,
                'listing_board' => $request->listing_board,
            ]);

            return redirect()->route('list-emiten')->with('succes', 'Emiten added successfully');
        }

        return view('pages.emiten.add');
    }
}
