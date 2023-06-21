@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('assets/plugins/fullcalendar/main.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
@endpush


@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    @if (auth()->user()->id_level == 1)
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Selamat Datang, {{ auth()->user()->nm_depan }} {{ auth()->user()->nm_belakang }}
                </h4>
            </div>
        </div>
        <div class="d-none d-xl-inline">
            <div class="row">
                <div class="col-12 col-xl-12 stretch-card">
                    <div class="row">
                        <div class="row flex-grow-1">
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <h6 class="card-title mb-0">Jumlah Pengguna</h6>
                                            <div class="dropdown mb-2">
                                                <button class="btn p-0" type="button" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i>
                                                        <span class="">View</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row text-success">
                                            <div class="col-8 col-md-12 col-xl-8">
                                                <h2 class="mb-2">{{ $users }}</h2>
                                            </div>
                                            <div class="col-4 col-md-12 col-xl-4">
                                                <i class="link-icon icon-xxl" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <h6 class="card-title mb-0">Unit Bisnis</h6>
                                            <div class="dropdown mb-2">
                                                <button class="btn p-0" type="button" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i>
                                                        <span class="">View</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row text-warning">
                                            <div class="col-8 col-md-12 col-xl-8">
                                                <h2 class="mb-2">{{ $divisi }}</h2>
                                            </div>
                                            <div class="col-4 col-md-12 col-xl-4">
                                                <i class="link-icon icon-xxl" data-feather="briefcase"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-grow-1">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <h6 class="card-title mb-2">Laporan Aktivitas</h6>
                                        </div>
                                        <div class="row justify-content-xl-center mt-2">
                                            <div class="col-4 col-xl-2 me-3">
                                                <div class="text-center">
                                                    <a href="{{ url('/selfdevelopment/reportsd') }}" type="button"
                                                        class="btn btn-inverse-danger"><img
                                                            src="{{ asset('assets/images/book-open-page-variant.png') }}"
                                                            width="50px" height="50px" alt=""></a>
                                                    <div class="my-2">
                                                        <h5 class="fs-sm-4 fs-6">Self-Development</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-xl-2 me-3">
                                                <div class="text-center">
                                                    <a href="{{ url('/bisnisprofit/reportbp') }}" type="button"
                                                        class="btn btn-inverse-success"><img
                                                            src="{{ asset('assets/images/chart-areaspline.png') }}"
                                                            width="50px" height="50px" alt=""></a>
                                                    <div class="my-2">
                                                        <h5 class="fs-sm-4 fs-6">Bisnis & Profit</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-xl-2 me-3">
                                                <div class="text-center">
                                                    <a href="{{ url('/kelembagaan/reportkl') }}" type="button"
                                                        class="btn btn-inverse-warning"><img
                                                            src="{{ asset('assets/images/bank.png') }}" width="50px"
                                                            height="50px" alt=""></a>
                                                    <div class="my-2">
                                                        <h5 class="fs-sm-4 fs-6">Kelembagaan</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-xl-2 me-3">
                                                <div class="text-center">
                                                    <a href="{{ url('/inovasicreativity/reportic') }}" type="button"
                                                        class="btn btn-inverse-info"><img
                                                            src="{{ asset('assets/images/brush.png') }}" width="50px"
                                                            height="50px" alt=""></a>
                                                    <div class="my-2">
                                                        <h5 class="fs-sm-4 fs-6">Inovasi & Creativity</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-xl-2 me-3">
                                                <div class="text-center">
                                                    <a href="{{ url('/evaluasi/reportev') }}" type="button"
                                                        class="btn btn-inverse-primary"><img
                                                            src="{{ asset('assets/images/clipboard-text.png') }}"
                                                            width="50px" height="50px" alt=""></a>
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
                    {{-- <div class=""> --}}
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Laporan Hari Ini</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <canvas id="chartjsBar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div> <!-- row -->
        </div>
        <div class="d-inline d-xl-none">
            <div class="row">
                <div class="col-12 col-xl-12 stretch-card">
                    <div class="row flex-grow-1">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="card-title mb-0">Jumlah Pengguna</h6>
                                        <div class="dropdown mb-2">
                                            <button class="btn p-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                        data-feather="eye" class="icon-sm me-2"></i> <span
                                                        class="">View</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-success">
                                        <div class="col-8 col-md-12 col-xl-8">
                                            <h2 class="mb-2">{{ $users }}</h2>
                                        </div>
                                        <div class="col-4 col-md-12 col-xl-4">
                                            <i class="link-icon icon-xxl" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="card-title mb-0">Unit Bisnis</h6>
                                        <div class="dropdown mb-2">
                                            <button class="btn p-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                        data-feather="eye" class="icon-sm me-2"></i> <span
                                                        class="">View</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-warning">
                                        <div class="col-8 col-md-12 col-xl-8">
                                            <h2 class="mb-2">{{ $divisi }}</h2>
                                        </div>
                                        <div class="col-4 col-md-12 col-xl-4">
                                            <i class="link-icon icon-xxl" data-feather="briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Laporan Hari Ini</h6>
                                <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="eye" class="icon-sm me-2"></i> <span
                                                class="">View</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <canvas id="chartjsBar2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
                {{-- <div class="row"> --}}
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Laporan Aktivitas</h6>
                            </div>
                            <div class="row justify-content-xl-center mt-2">
                                <div class="col-4 col-xl-2">
                                    <div class="text-center">
                                        <a href="{{ url('/newsd') }}" type="button" class="btn btn-inverse-danger"><img
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
                                                src="{{ asset('assets/images/chart-areaspline.png') }}" width="50px"
                                                height="50px" alt=""></a>
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
                                                height="50px" alt="">
                                        </a>
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

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Pengguna</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Divisi</th>
                                        <th style="width: 1rem;">Status</th>
                                        <th style="width: 1rem;">Riwayat Login</th>
                                        <th style="width: 1rem;">Laporan Harian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengguna as $user)
                                        <tr>
                                            <td>{{ $user->nm_depan }} {{ $user->nm_belakang }}</td>
                                            <td>{{ $user->divisi->divisi }}</td>
                                            <td>
                                                @if ($user->isOnline())
                                                    <span class="badge bg-success text-white">Online</span>
                                                @else
                                                    <span class="badge bg-danger text-white">Offline</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($user->last_login_at)->format('d-M-Y H:i:s') }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button"
                                                    class="btn btn-inverse-secondary btn-xs btn-icon"data-bs-toggle="modal"
                                                    data-bs-target="#viewModal-{{ $user->id }}"><i data-feather="eye"
                                                        class="icon-sm"></i></button>
                                            </td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="viewModal-{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Laporan Harian
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col mb-3">
                                                                <label class="form-label fw-bold">
                                                                    {{ $user->nm_depan }}
                                                                    {{ $user->nm_belakang }}</label> <br>
                                                                {{ $user->divisi->divisi }} <br>
                                                                {{ $user->nohp }} <br>
                                                                {{ $user->email }}
                                                            </div>
                                                            <div class="col mb-3">
                                                                <p class="d-flex justify-content-between">
                                                                    <span><i
                                                                            class="mdi mdi-book-open-page-variant text-danger"></i>
                                                                        Self-Development:</span>
                                                                    <span>{{ gmdate('H:i:s', $user->totalSd) }}<b>
                                                                            /01:00:00</b></span>
                                                                </p>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                                        style="width: {{ $user->percentageSd }}%"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                                <p class="d-flex justify-content-between">
                                                                    <span><i
                                                                            class="mdi mdi-chart-areaspline text-success"></i>
                                                                        Bisnis &
                                                                        Profit:</span>
                                                                    <span>{{ gmdate('H:i:s', $user->totalBp) }}<b>
                                                                            /04:00:00</b></span>
                                                                </p>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success"
                                                                        role="progressbar"
                                                                        style="width: {{ $user->percentageBp }}%"
                                                                        aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                                <p class="d-flex justify-content-between">
                                                                    <span><i class="mdi mdi-bank text-warning"></i>
                                                                        Kelembagaan:</span>
                                                                    <span>{{ gmdate('H:i:s', $user->totalKl) }}<b>
                                                                            /00:30:00</b></span>
                                                                </p>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-warning"
                                                                        role="progressbar"
                                                                        style="width: {{ $user->percentageKl }}%"
                                                                        aria-valuenow="75" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                                <p class="d-flex justify-content-between">
                                                                    <span><i class="mdi mdi-brush text-info"></i> Inovasi &
                                                                        Creativity:</span>
                                                                    <span>{{ gmdate('H:i:s', $user->totalIc) }}<b>
                                                                            /00:30:00</b></span>
                                                                </p>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-info" role="progressbar"
                                                                        style="width: {{ $user->percentageIc }}%"
                                                                        aria-valuenow="100" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col mb-3">
                                                                <label class="form-label fw-bold">Laporan
                                                                    Harian</label><br>
                                                                <span><i
                                                                        class="mdi mdi-book-open-page-variant text-danger"></i>
                                                                    Self-Development:</span>
                                                                {{ $dailysdCounts[$user->id] }} <br>
                                                                <span><i class="mdi mdi-chart-areaspline text-success"></i>
                                                                    Bisnis & Profit:</span>
                                                                {{ $dailybpCounts[$user->id] }}<br>
                                                                <span><i class="mdi mdi-bank text-warning"></i>
                                                                    Kelembagaan:</span>
                                                                {{ $dailyklCounts[$user->id] }}<br>
                                                                <span><i class="mdi mdi-brush text-info"></i>
                                                                    Inovasi & Creativity:</span>
                                                                {{ $dailyicCounts[$user->id] }}<br>
                                                                <span><i
                                                                        class="mdi mdi mdi-clipboard-text text-primary"></i>
                                                                    Evaluasi Harian:</span>
                                                                {{ $dailyevCounts[$user->id] }}<br>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (auth()->user()->id_level == 2)
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Selamat Datang, {{ Auth::guard('divisi')->user()->divisi->divisi }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Jumlah Anggota Divisi</h6>
                                    <div class="dropdown mb-2">

                                    </div>
                                </div>
                                <div class="row text-success">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $userDivisi }}</h3>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-success" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Rencana Kegiatan Bulan Ini</h6>
                                    <div class="dropdown mb-2">

                                    </div>
                                </div>
                                <div class="row text-warning">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $weeklyPlanCount }}</h3>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-warning" data-feather="calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Tambah Rencana Kegiatan</h6>
                                    <div class="dropdown mb-2">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">
                                            <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <h6>Tambah</h6>
                                            </button>
                                        </h3>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-danger" data-feather="plus"></i>
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
                                <h6 class="card-title">Daftar Rencana Kegiatan</h6>
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="btn-close"></button>
                                            </div>
                                            <form onsubmit="$('#submit').prop('disabled',true)"
                                                action="{{ route('weekly.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="defaultconfig-6" class="col-form-label">Mulai
                                                                Kegiatan</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" name="start_date" type="date"
                                                                autocomplete="off" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="defaultconfig-6" class="col-form-label">Selesai
                                                                Kegiatan</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" name="end_date" type="date"
                                                                autocomplete="off" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="defaultconfig-2" class="col-form-label">Rencana
                                                                Kegiatan</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4" name="rencana" maxlength="2500"
                                                                rows="6" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        style="width: 6rem">Tambah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id='external-events' class='external-events'>
                                    @foreach ($weeklyPlan as $wk)
                                        <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'
                                            style="background-color:rgba(13, 250, 1, 0.15)">
                                            <div class='fc-event-main'>
                                                {{ $wk->start_date }},
                                                <?php
                                                $num_char = 10;
                                                $text = $wk->rencana;
                                                echo substr($text, 0, $num_char) . '...';
                                                ?>
                                            </div>
                                        </div>
                                    @endforeach
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
                        <div class="modal fade" id="lihatRencana" tabindex="-1"
                            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Tanggal
                                                Mulai Kegiatan</label>
                                            <input type="text" class="form-control" id="start_date" readonly
                                                style="background-color: #f5f5f5;" />
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Tanggal
                                                Selesai Kegiatan</label>
                                            <input type="text" class="form-control" id="end_date" readonly
                                                style="background-color: #f5f5f5;" />
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Rencana</label>
                                            <textarea class="form-control" id="rencana" maxlength="255" rows="8" readonly
                                                style="background-color: #f5f5f5;"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
                                                                        <label class="form-check-label"
                                                                            for="radioInline1">
                                                                            1 Interval
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="interval_sd" id="radioInline2"
                                                                            value="3600">
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
                                            <a href="{{ url('/selfdevelopment/newsd') }}" type="button"
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
                                <h6 class="card-title mb-4">Rencana Mingguan</h6>
                                <div id='external-events' class='external-events'>
                                    @foreach ($weekly as $wk)
                                        <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'
                                            style="background-color:rgba(13, 250, 1, 0.15)">
                                            <div class='fc-event-main'>
                                                {{ $wk->start_date }},
                                                <?php
                                                $num_char = 10;
                                                $text = $wk->rencana;
                                                echo substr($text, 0, $num_char) . '...';
                                                ?>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div id='fullcalendar2'></div>
                            </div>
                        </div>
                        <div class="modal fade" id="lihatRencana" tabindex="-1"
                            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Tanggal
                                                Mulai Kegiatan</label>
                                            <input type="text" class="form-control" id="start_date" readonly
                                                style="background-color: #f5f5f5;" />
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Tanggal
                                                Selesai Kegiatan</label>
                                            <input type="text" class="form-control" id="end_date" readonly
                                                style="background-color: #f5f5f5;" />
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Rencana</label>
                                            <textarea class="form-control" id="rencana" maxlength="255" rows="8" readonly
                                                style="background-color: #f5f5f5;"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    {{-- <script src="{{ asset('assets/plugins/fullcalendar/main.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/fullcalendar.js') }}"></script> --}}
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        @if (Session::has('success'))
            window.onload = () => showSwal('mixin', '{{ Session::get('success') }}')
        @endif
    </script>
    <script>
        var colors = {
            primary: "#6571ff",
            secondary: "#7987a1",
            success: "#05a34a",
            info: "#66d1d1",
            warning: "#fbbc06",
            danger: "#ff3366",
            light: "#e9ecef",
            dark: "#060c17",
            muted: "#7987a1",
            gridBorder: "rgba(77, 138, 240, .15)",
            bodyColor: "#000",
            cardBg: "#fff",
        };

        var fontFamily = "'Roboto', Helvetica, sans-serif";
        var ctx = document.getElementById('chartjsBar').getContext('2d');
        var dailysd = @json($dailysd);
        var dailybp = @json($dailybp);
        var dailykl = @json($dailykl);
        var dailyic = @json($dailyic);
        var evaluate = @json($evaluate);

        var chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: [
                    "Self-Development",
                    "Bisnis & Profit",
                    "Kelembagaan",
                    "Inovasi & Creativity",
                    "Evaluasi Harian",
                ],
                datasets: [{
                    label: "Total",
                    backgroundColor: [
                        colors.danger,
                        colors.success,
                        colors.warning,
                        colors.info,
                        colors.primary,
                    ],
                    data: [dailysd, dailybp, dailykl, dailyic, evaluate],
                }, ],
            },
            options: {
                aspectRatio: 2,
                plugins: {
                    legend: {
                        display: false
                    },
                },
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: true,
                            color: colors.gridBorder,
                            borderColor: colors.gridBorder,
                        },
                        ticks: {
                            color: colors.bodyColor,
                            font: {
                                size: 12,
                            },
                        },
                    },
                    y: {
                        grid: {
                            display: true,
                            color: colors.gridBorder,
                            borderColor: colors.gridBorder,
                        },
                        ticks: {
                            color: colors.bodyColor,
                            font: {
                                size: 12,
                            },
                        },
                    },
                },
            },
        });

        var colors = {
            primary: "#6571ff",
            secondary: "#7987a1",
            success: "#05a34a",
            info: "#66d1d1",
            warning: "#fbbc06",
            danger: "#ff3366",
            light: "#e9ecef",
            dark: "#060c17",
            muted: "#7987a1",
            gridBorder: "rgba(77, 138, 240, .15)",
            bodyColor: "#000",
            cardBg: "#fff",
        };

        var fontFamily = "'Roboto', Helvetica, sans-serif";
        var ctx = document.getElementById('chartjsBar2').getContext('2d');
        var dailysd = @json($dailysd);
        var dailybp = @json($dailybp);
        var dailykl = @json($dailykl);
        var dailyic = @json($dailyic);
        var evaluate = @json($evaluate);

        var chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: [
                    "Self-Development",
                    "Bisnis & Profit",
                    "Kelembagaan",
                    "Inovasi & Creativity",
                    "Evaluasi Harian",
                ],
                datasets: [{
                    label: "Total",
                    backgroundColor: [
                        colors.danger,
                        colors.success,
                        colors.warning,
                        colors.info,
                        colors.primary,
                    ],
                    data: [dailysd, dailybp, dailykl, dailyic, evaluate],
                }, ],
            },
            options: {
                aspectRatio: 2,
                plugins: {
                    legend: {
                        display: false
                    },
                },
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: true,
                            color: colors.gridBorder,
                            borderColor: colors.gridBorder,
                        },
                        ticks: {
                            color: colors.bodyColor,
                            font: {
                                size: 12,
                            },
                        },
                    },
                    y: {
                        grid: {
                            display: true,
                            color: colors.gridBorder,
                            borderColor: colors.gridBorder,
                        },
                        ticks: {
                            color: colors.bodyColor,
                            font: {
                                size: 12,
                            },
                        },
                    },
                },
            },
        });
    </script>
    <script>
        $(document).ready(function() {
            var color = 'rgba(13, 250, 1, 0.15)';
            var calendar = $('#fullcalendar').fullCalendar({
                editable: false,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: '/events',
                displayEventTime: false,
                selectable: true,
                selectHelper: true,
                themeSystem: 'standard',
                eventRender: function(event, element) {
                    element.css('background-color', color);
                },
                eventClick: function(event) {
                    $.get('/events/' + event.id, function(data) {
                        $('#exampleModalScrollableTitle').text('Detail Rencana Kerja');
                        $('#lihatRencana').modal('show');
                        $('#start_date').val(moment(data.start_date).format(
                            'YYYY-MM-DD HH:mm:ss'));
                        $('#end_date').val(moment(data.end_date).format(
                            'YYYY-MM-DD HH:mm:ss'));
                        $('#rencana').val(data.rencana);
                    });
                },
            });
        });

        $(document).ready(function() {
            var color = 'rgba(13, 250, 1, 0.15)';
            var calendar = $('#fullcalendar2').fullCalendar({
                editable: false,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: '/eventsUser',
                displayEventTime: false,
                selectable: true,
                selectHelper: true,
                themeSystem: 'standard',
                eventRender: function(event, element) {
                    element.css('background-color', color);
                },
                eventClick: function(event) {
                    $.get('/eventsUser/' + event.id, function(data) {
                        $('#exampleModalScrollableTitle').text('Detail Rencana Kerja');
                        $('#lihatRencana').modal('show');
                        $('#start_date').val(moment(data.start_date).format(
                            'YYYY-MM-DD HH:mm:ss'));
                        $('#end_date').val(moment(data.end_date).format('YYYY-MM-DD HH:mm:ss'));
                        $('#rencana').val(data.rencana);
                    });
                },
            });
        });
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
@endpush
