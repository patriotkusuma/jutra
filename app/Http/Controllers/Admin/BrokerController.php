<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BrokerController extends Controller
{
    public function index(Request $request){
        $brokers = auth()->user()->brokers;

        return view('pages.broker.index', compact('brokers'));
    }

    public function add(Request $request){
        if($request->has('name')){
            $request->validate([
                'name' => 'required',
                'buy_fee' => 'required',
                'sell_fee' => 'required'
            ]);

            $brokers = Broker::create([
                'name' => $request->name,
                'buy_fee' => $request->buy_fee,
                'sell_fee' => $request->sell_fee,
                'user_id' => auth()->user()->id,
                'broker_code' => $request->broker_code,
            ]);
            return redirect()->route('list-broker');
        }
        return view('pages.broker.add');
    }

    public function edit($id, Request $request){
        if($request->has('name')){
            $request->validate([
                'name' => 'required',
                'buy_fee' => 'required',
                'sell_fee' => 'required'
            ]);

            return redirect()->route('list-broker')->with('succes', 'Broker '. $request->name . ' berhasil diubah.');
        }

        $broker = Broker::find($id);

        return view('pages.broker.add', compact('broker'));
    }

    public function remove($id, Request $request){

    }
}
