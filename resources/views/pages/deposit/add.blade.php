@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">

                            <h6>Tambah Deposit</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container">
                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="name">Nama Broker <span>*</span></label>
                                            <select name="broker_id" id="" class="form-select select2">
                                                <option value="">Pilih Broker</option>
                                                @foreach (auth()->user()->brokers as $broker)
                                                    <option value="{{ $broker->id }}"
                                                        {{ isset($deposit) ?? $broker->id == $deposit->broker_id ? 'selected' : '' }}>
                                                        {{ $broker->name . ' | ' . ($broker->buy_fee + $broker->sell_fee) . ' %' }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_fee">Total <span>(Rp) *</span></label>
                                            <input type="number" min="0" name="total" placeholder="2000000"
                                                class="form-control"
                                                value="{{ old('total') ?? isset($deposit) ? $deposit->total : '' }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="buy_fee">Tanggal Deposit<span> *</span></label>
                                            <input type="text" name="deposit_date" class="form-control datepicker"
                                                value="{{ old('deposit_date') ?? isset($deposit) ? \Carbon\Carbon::parse($deposit->deposit_date)->toDateString() : '' }}" />
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('list-deposit') }}" type="submit"
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
@push('js')
    <script>
        $(document).ready(function() {

            $('.datepicker').daterangepicker({
                drops: 'auto',
                autoUpdateInput: false,
                singleDatePicker: true,
                autoApply: true,
                locale: {
                    format: 'MM/DD/YYYY',
                    "fromLabel": "Dari",
                    "toLabel": "Sampai",
                    "customRangeLabel": "Custom",
                    "daysOfWeek": ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                    "monthNames": ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                        "Augustus", "September", "Oktober", "November", "Desember"
                    ],
                    "firstDay": 1
                },

            });
            $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
        });
    </script>
@endpush
