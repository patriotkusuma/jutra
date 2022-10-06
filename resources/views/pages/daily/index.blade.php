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
                                <a href="{{ route('add-emiten') }}" class="btn btn-primary btn-sm ms-auto">Refresh Daily</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container">

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="table-emiten">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase w-5 text-secondary text-xxs font-weight-bolder opacity-7">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $.fn.dataTable.render.moment = function(from, to, locale) {
                // Argument shifting
                if (arguments.length === 1) {
                    locale = 'en';
                    to = from;
                    from = 'YYYY-MM-DD';
                } else if (arguments.length === 2) {
                    locale = 'en';
                }

                return function(d, type, row) {
                    if (!d) {
                        return type === 'sort' || type === 'type' ? 0 : d;
                    }

                    var m = window.moment(d, from, locale, true);

                    // Order and type get a number value from Moment, everything else
                    // sees the rendered value
                    return m.format(type === 'sort' || type === 'type' ? 'x' : to);
                };
            };
            const $dataTable = $('#table-emiten');
            $dataTable.DataTable({
                // pagingType: 'simple',
                processing: true,
                serverSide: true,
                ajax: '{{ route('json-list-emiten') }}',
                "language": {
                    "thousands": "'"
                },
                oLanguage: {
                    oPaginate: {
                        sNext: '<i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<i class="fa fa-chevron-left" ></i></span>'
                    }
                },
                "columnDefs": [{
                    "className": "dt-center",
                    "targets": "_all"
                }],
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type,row,meta) {
                            return `
                            <h6>` + (meta.row + meta.settings._iDisplayStart +1) + `</h6>
                            `;
                        }
                    },
                    {
                        data: 'code',
                        name: 'code',
                        render: function(data, type) {
                            return `
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">` + data + `</h6>
                                </div>
                            </div>
                            `;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type) {
                            return `
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">` + data + `</h6>
                                </div>
                            </div>
                            `;
                        }
                    },
                    {
                        data: 'listing_date',
                        name: 'listing_date',
                        render: function(data, type) {
                            return `
                            <p class="text-xs font-weight-bold mb-0">
                                ` + data + `
                            </p>
                            `;
                        }
                    },
                    {
                        data: 'shares',
                        name: 'shares',
                        render: $.fn.dataTable.render.number(',', '.', 0, '')
                    },
                    {
                        data: 'listing_board',
                        name: 'listing_board',
                        render: function(data, type) {
                            if (data == 'Utama') {
                                return `<span class="badge badge-sm bg-gradient-success">` + data +
                                    `</span>`;
                            }
                            if (data == 'Pengembangan') {
                                return `<span class="badge badge-sm bg-gradient-warning">` + data +
                                    `</span>`;
                            }
                            if (data == 'Akselerasi') {
                                return `<span class="badge badge-sm bg-gradient-danger">` + data +
                                    `</span>`;
                            }
                        }
                    },
                ]
            });

            // $.ajax({
            //     type: "get",
            //     url: "{{ route('json-list-emiten') }}",
            //     data: "data",
            //     dataType: "json",
            //     success: function (response) {
            //         console.log(response.data[0]);
            //     }
            // });
        });
    </script>
@endpush
