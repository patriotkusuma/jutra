@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">

                            <h6>Tambah Broker</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container">
                            <form method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Broker <span>*</span></label>
                                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Ex: Contoh Andalan Sekuritas" value="{{old('name') ?? (isset($broker) ? $broker->name :'')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="buy_fee">Kode Broker <span>*</span></label>
                                            <input type="text" name="broker_code" placeholder="ex: EX" class="form-control" value="{{old('broker_code') ?? isset($broker) ? $broker->broker_code : ''}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="buy_fee">Buy Fee <span>(%) *</span></label>
                                            <input type="number" step=".01" name="buy_fee" placeholder="0.2" class="form-control" value="{{old('buy_fee') ?? isset($broker) ? $broker->buy_fee : ''}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_fee">Sell Fee <span>(%) *</span></label>
                                            <input type="number" step=".01" name="sell_fee" placeholder="0.2" class="form-control" value="{{old('sell_fee') ??isset($broker) ? $broker->sell_fee : ''}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{route('list-broker')}}" type="submit" class="btn btn-secondary btn-sm ms-auto">
                                            <i class="fa fa-arrow-left my-auto" aria-hidden="true"></i>
                                            Kembali
                                        </a>
                                        <button type="submit" class="btn btn-dark btn-sm ms-auto">
                                            <i class="fa fa-save my-auto" aria-hidden="true"></i>
                                            Simpan
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
