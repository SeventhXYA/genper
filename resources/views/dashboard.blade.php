@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/fullcalendar/main.min.css') }}" rel="stylesheet" />
@endpush


@section('content')
    @if (auth()->user()->id_level == 3)
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Selamat Datang, {{ auth()->user()->nm_depan }}</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Interval Report</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal"
                                                data-bs-target="#addInterval"><i data-feather="plus"
                                                    class="icon-sm me-2"></i>
                                                <span class="">Tambah</span></a>
                                            <a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal"
                                                data-bs-target="#editInterval"><i data-feather="edit-2"
                                                    class="icon-sm me-2"></i>
                                                <span class="">Edit</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="trash" class="icon-sm me-2"></i> <span
                                                    class="">Delete</span></a>
                                        </div>
                                        <div class="example">
                                            <div class="modal fade" id="addInterval" tabindex="-1"
                                                aria-labelledby="addIntervalTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addIntervalTitle">Masukan Data
                                                                Interval
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="btn-close"></button>
                                                        </div>
                                                        <form onsubmit="$('#submit').prop('disabled',true)"
                                                            action="{{ route('interval.store') }}" method="POST"
                                                            class="w-full">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="">
                                                                    <span class="badge bg-success card-title">
                                                                        <h6>Self-Development</h6>
                                                                    </span><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_sd" id="radioInline"
                                                                            value="0">
                                                                        <label class="form-check-label" for="radioInline">
                                                                            0 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_sd" id="radioInline1"
                                                                            value="1800">
                                                                        <label class="form-check-label" for="radioInline1">
                                                                            1 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_sd" id="radioInline2"
                                                                            value="3600">
                                                                        <label class="form-check-label" for="radioInline2">
                                                                            2 Interval
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <span class="badge bg-success card-title">
                                                                        <h6>Bisnis & Profit</h6>
                                                                    </span><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_bp" id="radioInline3"
                                                                            value="0">
                                                                        <label class="form-check-label"
                                                                            for="radioInline3">
                                                                            0 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_bp" id="radioInline4"
                                                                            value="1800">
                                                                        <label class="form-check-label"
                                                                            for="radioInline4">
                                                                            1 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_bp" id="radioInline5"
                                                                            value="3600">
                                                                        <label class="form-check-label"
                                                                            for="radioInline5">
                                                                            2 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_bp" id="radioInline6"
                                                                            value="5400">
                                                                        <label class="form-check-label"
                                                                            for="radioInline6">
                                                                            3 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_bp" id="radioInline7"
                                                                            value="7200">
                                                                        <label class="form-check-label"
                                                                            for="radioInline7">
                                                                            4 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_bp" id="radioInline8"
                                                                            value="9000">
                                                                        <label class="form-check-label"
                                                                            for="radioInline8">
                                                                            5 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_bp" id="radioInline9"
                                                                            value="10800">
                                                                        <label class="form-check-label"
                                                                            for="radioInline9">
                                                                            6 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_bp" id="radioInline10"
                                                                            value="12600">
                                                                        <label class="form-check-label"
                                                                            for="radioInline10">
                                                                            7 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_bp" id="radioInline11"
                                                                            value="14400">
                                                                        <label class="form-check-label"
                                                                            for="radioInline11">
                                                                            8 Interval
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <span class="badge bg-success card-title">
                                                                        <h6>Kelembagaan</h6>
                                                                    </span><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_kl" id="radioInline12"
                                                                            value="0">
                                                                        <label class="form-check-label"
                                                                            for="radioInline12">
                                                                            0 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_kl" id="radioInline13"
                                                                            value="1800">
                                                                        <label class="form-check-label"
                                                                            for="radioInline13">
                                                                            1 Interval
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <span class="badge bg-success card-title">
                                                                        <h6>Inovasi & Creativity</h6>
                                                                    </span><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_ic" id="radioInline14"
                                                                            value="0">
                                                                        <label class="form-check-label"
                                                                            for="radioInline14">
                                                                            0 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_ic" id="radioInline15"
                                                                            value="1800">
                                                                        <label class="form-check-label"
                                                                            for="radioInline15">
                                                                            1 Interval
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit" id="submit"
                                                                    class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="example">
                                            <div class="modal fade" id="editInterval" tabindex="-1"
                                                aria-labelledby="editIntervalTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editIntervalTitle">Masukan Data
                                                                Interval
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                        </div>
                                                        <form onsubmit="$('#submit').prop('disabled',true)"
                                                            action="{{ route('interval.store') }}" method="POST"
                                                            class="w-full">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="">
                                                                    <span class="badge bg-success card-title">
                                                                        <h6>Self-Development</h6>
                                                                    </span><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline" id="radioInline">
                                                                        <label class="form-check-label" for="radioInline">
                                                                            0 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline" id="radioInline1">
                                                                        <label class="form-check-label"
                                                                            for="radioInline1">
                                                                            1 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline" id="radioInline2">
                                                                        <label class="form-check-label"
                                                                            for="radioInline2">
                                                                            2 Interval
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <span class="badge bg-success card-title">
                                                                        <h6>Bisnis & Profit</h6>
                                                                    </span><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline1" id="radioInline3">
                                                                        <label class="form-check-label"
                                                                            for="radioInline3">
                                                                            0 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline1" id="radioInline4">
                                                                        <label class="form-check-label"
                                                                            for="radioInline4">
                                                                            1 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline1" id="radioInline5">
                                                                        <label class="form-check-label"
                                                                            for="radioInline5">
                                                                            2 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline1" id="radioInline6">
                                                                        <label class="form-check-label"
                                                                            for="radioInline6">
                                                                            3 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline1" id="radioInline7">
                                                                        <label class="form-check-label"
                                                                            for="radioInline7">
                                                                            4 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline1" id="radioInline8">
                                                                        <label class="form-check-label"
                                                                            for="radioInline8">
                                                                            5 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline1" id="radioInline9">
                                                                        <label class="form-check-label"
                                                                            for="radioInline9">
                                                                            6 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline1" id="radioInline10">
                                                                        <label class="form-check-label"
                                                                            for="radioInline10">
                                                                            7 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline1" id="radioInline11">
                                                                        <label class="form-check-label"
                                                                            for="radioInline11">
                                                                            8 Interval
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <span class="badge bg-success card-title">
                                                                        <h6>Kelembagaan</h6>
                                                                    </span><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline2" id="radioInline12">
                                                                        <label class="form-check-label"
                                                                            for="radioInline12">
                                                                            0 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline2" id="radioInline13">
                                                                        <label class="form-check-label"
                                                                            for="radioInline13">
                                                                            1 Interval
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <span class="badge bg-success card-title">
                                                                        <h6>Inovasi & Creativity</h6>
                                                                    </span><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline3" id="radioInline14">
                                                                        <label class="form-check-label"
                                                                            for="radioInline14">
                                                                            0 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="radioInline3" id="radioInline15">
                                                                        <label class="form-check-label"
                                                                            for="radioInline15">
                                                                            1 Interval
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit" id="submit"
                                                                    class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row"> --}}
                                <p class="d-flex justify-content-between">
                                    <span><i class="mdi mdi-book-open-page-variant"></i>
                                        Self-Development:</span>
                                    <span>{{ gmdate('H:i:s', $user->totalSd) }}<b> /01:00:00</b></span>
                                </p>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $user->percentageSd }}%" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <p class="d-flex justify-content-between">
                                    <span><i class="mdi mdi-chart-areaspline"></i> Bisnis & Profit:</span>
                                    <span>{{ gmdate('H:i:s', $user->totalBp) }}<b> /04:00:00</b></span>
                                </p>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $user->percentageBp }}%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <p class="d-flex justify-content-between">
                                    <span><i class="mdi mdi-bank"></i> Kelembagaan:</span>
                                    <span>{{ gmdate('H:i:s', $user->totalKl) }}<b> /00:30:00</b></span>
                                </p>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $user->percentageKl }}%" aria-valuenow="75" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <p class="d-flex justify-content-between">
                                    <span><i class="mdi mdi-brush"></i> Inovasi & Creativity:</span>
                                    <span>{{ gmdate('H:i:s', $user->totalIc) }}<b> /00:30:00</b></span>
                                </p>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: {{ $user->percentageIc }}%" aria-valuenow="100" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-2">Laporan Aktivitas</h6>

                                </div>
                                <div class="row justify-content-xl-center mt-2">
                                    <div class="col-4 col-xl-2">
                                        <div class="text-center">
                                            <a href="{{ url('/newsd') }}" type="button"
                                                class="btn btn-inverse-danger"><img
                                                    src="{{ asset('assets/images/book-open-page-variant.png') }}"
                                                    width="50px" height="50px" alt=""></a>
                                            <div class="my-2">
                                                <h5 class="fs-sm-4 fs-6">Self-Development</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-xl-2">
                                        <div class="text-center">
                                            <a href="{{ url('/bisnisprofit/newbp') }}" type="button"
                                                class="btn btn-inverse-success"><img
                                                    src="{{ asset('assets/images/chart-areaspline.png') }}"
                                                    width="50px" height="50px" alt=""></a>
                                            <div class="my-2">
                                                <h5 class="fs-sm-4 fs-6">Bisnis & Profit</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-xl-2">
                                        <div class="text-center">
                                            <a href="{{ url('/kelembagaan/newkl') }}" type="button"
                                                class="btn btn-inverse-warning"><img
                                                    src="{{ asset('assets/images/bank.png') }}" width="50px"
                                                    height="50px" alt=""></a>
                                            <div class="my-2">
                                                <h5 class="fs-sm-4 fs-6">Kelembagaan</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-xl-2">
                                        <div class="text-center">
                                            <a href="{{ url('/inovasicreativity/newic') }}" type="button"
                                                class="btn btn-inverse-info"><img
                                                    src="{{ asset('assets/images/brush.png') }}" width="50px"
                                                    height="50px" alt=""></a>
                                            <div class="my-2">
                                                <h5 class="fs-sm-4 fs-6">Inovasi & Creativity</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-xl-2">
                                        <div class="text-center">
                                            <a href="{{ url('/evaluasi/newev') }}" type="button"
                                                class="btn btn-inverse-primary"><img
                                                    src="{{ asset('assets/images/clipboard-text.png') }}" width="50px"
                                                    height="50px" alt=""></a>
                                            <div class="my-2">
                                                <h5 class="fs-sm-4 fs-6">Evaluasi Harian</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3 d-none d-md-block">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Full calendar</h6>
                                <div id='external-events' class='external-events'>
                                    <h6 class="mb-2 text-muted">Draggable Events</h6>
                                    <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                                        <div class='fc-event-main'>Birth Day</div>
                                    </div>
                                    <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                                        <div class='fc-event-main'>New Project</div>
                                    </div>
                                    <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                                        <div class='fc-event-main'>Anniversary</div>
                                    </div>
                                    <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                                        <div class='fc-event-main'>Clent Meeting</div>
                                    </div>
                                    <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                                        <div class='fc-event-main'>Office Trip</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div id='fullcalendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="fullCalModal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modalTitle1" class="modal-title"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"><span
                                class="visually-hidden">close</span></button>
                    </div>
                    <div id="modalBody1" class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Event Page</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="createEventModal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modalTitle2" class="modal-title">Add event</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"><span
                                class="visually-hidden">close</span></button>
                    </div>
                    <div id="modalBody2" class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Example label</label>
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                    placeholder="Example input">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Another label</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2"
                                    placeholder="Another input">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs.js') }}"></script>
    <script>
        @if (Session::has('success'))
            window.onload = () => showSwal('mixin', '{{ Session::get('success') }}')
        @endif
    </script>
@endpush
