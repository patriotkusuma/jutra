@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">

                            <h6>Daftar Broker</h6>
                            <a href="{{ route('add-broker') }}" class="btn btn-primary btn-sm ms-auto">Tambah Broker</a>
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
                                            Buy Fee</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Sell Fee</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($brokers->count() > 0)
                                        @foreach ($brokers as $broker)
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <h6>{{ $loop->iteration }}</h6>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $broker->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-start">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $broker->buy_fee . ' %' }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $broker->sell_fee . ' %' }}
                                                    </p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('edit-broker', ['id' => $broker->id]) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('edit-broker', ['id' => $broker->id]) }}"
                                                        class="text-danger font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var dataTable = $('#table-broker');
            dataTable.dataTable();
        });
    </script>
@endsection
