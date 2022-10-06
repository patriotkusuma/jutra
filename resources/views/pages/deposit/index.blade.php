@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Riwayat Deposit'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card h-100 mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">

                            <h6>Daftar Emiten</h6>
                            <a href="{{ route('add-deposit') }}" class="btn btn-primary btn-sm ms-auto">Tambah Deposit</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="table-broker">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase w-5 text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Broker</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jumlah Deposit</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Deposit</th>

                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($deposits))
                                        @foreach ($deposits as $deposit)
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <h6>{{ $loop->iteration }}</h6>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $deposit->broker->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{$deposit->broker->broker_code}}</p>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{'Rp. '.number_format($deposit->total,'2',',','.') }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ \Carbon\Carbon::parse($deposit->deposit_date)->translatedFormat('d F Y') }}
                                                    </p>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="{{route('edit-deposit',['id' => $deposit->id])}}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">
                                                <h6 class="mb-0 text-sm text-center">Data tidak ditemukan</h6>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer px-0 pt-0 pb-2">
                        <div class="container">
                            @if ($deposits != null)
                                {!! $deposits->links('components.pagination') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@section('js')
    <script></script>
@endsection
