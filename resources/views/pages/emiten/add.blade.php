@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">

                            <h6>Tambah Emiten</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container">
                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="row">
                                    <div class="form-group">
                                        <label for="" class="form-label">File Json, Excel</label>
                                        <input type="file" name="emiten" accept=".json, .csv, .xls" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark btn-sm ms-auto">
                                    <i class="fa fa-save my-auto" aria-hidden="true"></i>
                                    Simpan
                                </button> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Emiten <span>*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Ex: Contoh Perusahaan Tbk."
                                                value="{{ old('name') ?? (isset($emiten) ? $emiten->name : '') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="buy_fee">Kode Emiten <span>*</span></label>
                                            <input type="text" name="code" placeholder="ex: EX" class="form-control"
                                                value="{{ old('code') ?? isset($emiten) ? $emiten->code : '' }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="buy_fee">Listing Date<span> *</span></label>
                                            <input type="date" step=".01" name="listing_date" class="form-control"
                                                value="{{ old('listing_date') ?? isset($emiten) ? $emiten->listing_date : '' }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_fee">Shares <span>(%) *</span></label>
                                            <input type="number" min="0" name="shares" placeholder="0.2"
                                                class="form-control"
                                                value="{{ old('shares') ?? isset($emiten) ? $emiten->shares : '' }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label">Listing Board</label>
                                            <select class="form-select" name="listing_board" id="">
                                                <option value="" selected>Pilih Papan</option>
                                                <option value="Utama">Utama</option>
                                                <option value="Pengembangan">Pengembangan</option>
                                                <option value="Akselerasis">Akselerasi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('list-emiten') }}" type="submit"
                                            class="btn btn-secondary btn-sm ms-auto">
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
