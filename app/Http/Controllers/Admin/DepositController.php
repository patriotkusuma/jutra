<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index(Request $request){
        $deposits = auth()->user()->deposits()->paginate(10);

        return view('pages.deposit.index',compact('deposits'));

    }

    public function add(Request $request){
        if($request->has('total')){
            $request->validate([
                'total' => 'required|numeric',
                'broker_id' => 'required',
                'deposit_date' => 'required|date',
            ]);

            $deposits = Deposit::create([
                'total' => $request->total,
                'broker_id' => $request->broker_id,
                'user_id' => auth()->user()->id,
                'deposit_date' => Carbon::parse($request->deposit_date)->toDateString(),
            ]);

            return redirect()->route('list-deposit')->with('succes','Deposit Berhasil');
        }
        return view('pages.deposit.add');
    }

    public function edit($id, Request $request){
        if($request->has('total')){
            $request->validate([
                'total' => 'required|numeric',
                'broker_id' => 'required',
                'deposit_date' => 'required|date',
            ]);

            $deposit = Deposit::find($id);
            $deposit->update([
                'total' => $request->total,
                'broker_id' => $request->broker_id,
                'user_id' => auth()->user()->id,
                'deposit_date' => $request->deposit_date,
            ]);

            return redirect()->route('list-deposit')->with('succes','Deposit Diubah');
        }

        $deposit = Deposit::find($id);

        return view('pages.deposit.add', compact('deposit'));
    }
}
