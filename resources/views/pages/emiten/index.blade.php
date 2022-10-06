@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Daftar Emiten'])
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
                            @if (auth()->user()->username == 'patriotkusuma')
                                <a href="{{ route('add-emiten') }}" class="btn btn-primary btn-sm ms-auto">Tambah Emiten</a>
                            @endif
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
                                            Kode Emiten</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Pencatatan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Saham</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Papan Pencatatan</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($emitens->count() > 0)
                                        @foreach ($emitens as $emiten)
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <h6>{{ $loop->iteration }}</h6>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $emiten->code }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $emiten->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ \Carbon\Carbon::parse($emiten->listing_date)->translatedFormat('d F Y') }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ number_format($emiten->shares, '0', ',', '.') }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="badge badge-sm
                                                        @switch($emiten->listing_board)
                                                            @case('Utama')
                                                                bg-gradient-success
                                                                @break
                                                            @case('Pengembangan')
                                                                bg-gradient-warning
                                                                @break
                                                            @case('Akselerasi')
                                                                bg-gradient-danger
                                                                @break
                                                            @default

                                                        @endswitch
                                                    ">{{ $emiten->listing_board }}</span>
                                                </td>
                                                @if (auth()->user()->username == 'patriotkusuma')
                                                    <td class="align-middle">
                                                        <a href="{{ route('edit-emiten', ['id' => $emiten->id]) }}"
                                                            class="text-secondary font-weight-bold text-xs"
                                                            data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">
                                                <h6 class="mb-0 text-sm text-center">Data tidak ditemukan</h6>
                                                {{-- <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                </div>
                                            </div> --}}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer px-0 pt-0 pb-2">
                        <div class="container">
                            {!! $emitens->links('components.pagination') !!}
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
