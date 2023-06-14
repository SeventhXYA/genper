@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/slider/css/slider.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Weekly Plan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            <h6><i data-feather="plus" class="icon-sm"></i>
                                Tambah</h6>
                        </button>
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <form onsubmit="$('#submit').prop('disabled',true)" action="{{ route('weekly.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="defaultconfig-6" class="col-form-label">Mulai
                                                        Kegiatan</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input class="form-control" name="start_date" type="datetime-local"
                                                        autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="defaultconfig-6" class="col-form-label">Selesai
                                                        Kegiatan</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input class="form-control" name="end_date" type="datetime-local"
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
                    </div>
                    <div class="table-responsive d-none d-md-inline">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;"> Tgl Laporan </th>
                                    <th style="width:1rem;"> Lihat </th>
                                    <th style="width:1rem;"> Tanggal Kegiatan </th>
                                    <th style="width:24rem;"> Rencana </th>
                                    <th style="width:1rem;"> Status </th>
                                    <th style="width:1rem;"> Progres </th>
                                    <th style="width:1rem;"> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($weekly as $wk)
                                    <tr>
                                        <td>{{ $wk->created_at->format('d-M-Y') }}</td>
                                        <td><button type="button" class="btn btn-outline-secondary btn-xs btn-icon me-2"
                                                data-bs-toggle="modal" data-bs-target="#viewModal-{{ $wk->id }}"><i
                                                    data-feather="eye" class="icon-sm"></i></button></td>
                                        <td>{{ \Carbon\Carbon::parse($wk->start_date)->format('d-M-Y') }} <span
                                                class="badge bg-secondary text-white">s/d</span>
                                            {{ \Carbon\Carbon::parse($wk->end_date)->format('d-M-Y') }}
                                        </td>
                                        <td>
                                            <?php
                                            $num_char = 60;
                                            $text = $wk->rencana;
                                            echo substr($text, 0, $num_char) . '...';
                                            ?>
                                        </td>
                                        <td>
                                            @if ($wk->status == 0)
                                                <span class="badge bg-warning text-white">Berjalan</span>
                                            @elseif($wk->status == 1)
                                                <span class="badge bg-success text-white">Selesai</span>
                                            @elseif($wk->status == 2)
                                                <span class="badge bg-danger text-white">Tidak Selesai</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped @if ($wk->progres == 100) bg-success
                                                    @elseif ($wk->progres >= 50)
                                                    bg-warning
                                                    @elseif($wk->progres < 50)
                                                    bg-danger @endif"
                                                    role="progressbar" style="width: {{ $wk->progres }}%;"
                                                    aria-valuenow="{{ $wk->progres }}" aria-valuemin="0"
                                                    aria-valuemax="100">{{ $wk->progres }}%</div>
                                            </div>
                                        </td>
                                        <td class="d-flex inline">
                                            @if ($wk->status == 1 || $wk->status == 2 || ($wk->status == 0 && $wk->progres > 0))
                                                <button type="button" class="btn btn-outline-info btn-xs btn-icon me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#statusModal-{{ $wk->id }}"><i
                                                        data-feather="check-square" class="icon-sm"></i></button>
                                                <form name="delete" action="{{ route('weekly.delete', $wk) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-xs btn-icon"
                                                        data-id="{{ $wk->id }}"><i data-feather="trash"
                                                            class="icon-sm"></i></button>
                                                </form>
                                            @elseif($wk->status == 0)
                                                <button type="button" class="btn btn-outline-info btn-xs btn-icon me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#statusModal-{{ $wk->id }}"><i
                                                        data-feather="check-square" class="icon-sm"></i></button>
                                                <button type="button"
                                                    class="btn btn-outline-warning btn-xs btn-icon me-2"data-bs-toggle="modal"
                                                    data-bs-target="#editModal-{{ $wk->id }}"><i
                                                        data-feather="edit" class="icon-sm"></i></button>
                                                <form name="delete" action="{{ route('weekly.delete', $wk) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-xs btn-icon "
                                                        data-id="{{ $wk->id }}"><i data-feather="trash"
                                                            class="icon-sm"></i></button>
                                                </form>
                                            @endif

                                        </td>
                                    </tr>
                                    <div class="modal fade" id="statusModal-{{ $wk->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                        {{ $wk->created_at->format('d-M-Y') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="btn-close"></button>
                                                </div>
                                                <form onsubmit="$('#submit').prop('disabled',true)"
                                                    action="/weekly/update/{{ $wk->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="col mb-3">
                                                            <label for="exampleFormControlSelect1" class="form-label">
                                                                Status</label>
                                                            <select class="form-select" name="status"
                                                                id="exampleFormControlSelect1"
                                                                onchange="updateProgress()">
                                                                <option selected disabled value="{{ $wk->status }}">
                                                                    @if ($wk->status == 0)
                                                                        Berjalan
                                                                    @elseif($wk->status == 1)
                                                                        Selesai
                                                                    @else
                                                                        Tidak Selesai
                                                                    @endif
                                                                </option>
                                                                <option value="0"
                                                                    {{ $wk->status == 0 ? 'selected' : '' }}>Berjalan
                                                                </option>
                                                                <option value="1"
                                                                    {{ $wk->status == 1 ? 'selected' : '' }}>Selesai
                                                                </option>
                                                                <option value="2"
                                                                    {{ $wk->status == 2 ? 'selected' : '' }}>Tidak Selesai
                                                                </option>
                                                            </select>

                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="defaultconfig"
                                                                class="col-form-label">Progres</label>
                                                            <div class="container">
                                                                <input type="range" id="my-slider" min="0"
                                                                    max="100" value="{{ $wk->progres }}"
                                                                    name="progres" oninput="slider()">
                                                                <div id="slider-value">{{ $wk->progres }}%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            style="width: 6rem">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="viewModal-{{ $wk->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                        {{ $wk->created_at->format('d-M-Y') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="btn-close"></button>
                                                </div>
                                                <form onsubmit="$('#submit').prop('disabled',true)"
                                                    action="/weekly/update/{{ $wk->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Mulai Kegiatan</label>
                                                            <input class="form-control mb-4 mb-md-0" name="start_date"
                                                                data-inputmask="'alias': 'datetime'"
                                                                data-inputmask-inputformat="yyyy-mm-dd HH:MM:ss"
                                                                autocomplete="off"
                                                                value="{{ \Carbon\Carbon::parse($wk->start_date)->format('d-M-Y H:i:s') }}"
                                                                disabled readonly style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Selesai Kegiatan</label>
                                                            <input class="form-control mb-4 mb-md-0" name="end_date"
                                                                data-inputmask="'alias': 'datetime'"
                                                                data-inputmask-inputformat="yyyy-mm-dd HH:MM:ss"
                                                                autocomplete="off"
                                                                value="{{ \Carbon\Carbon::parse($wk->end_date)->format('d-M-Y H:i:s') }}"
                                                                disabled readonly style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Rencana</label>
                                                            <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4" name="rencana" maxlength="2500"
                                                                rows="6" readonly style="background-color: #f5f5f5;">{{ $wk->rencana }}</textarea>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Status</label><br>
                                                            @if ($wk->status == 0)
                                                                <span class="badge bg-warning text-white">Berjalan</span>
                                                            @elseif($wk->status == 1)
                                                                <span class="badge bg-success text-white">Selesai</span>
                                                            @elseif($wk->status == 2)
                                                                <span class="badge bg-danger text-white">Tidak
                                                                    Selesai</span>
                                                            @endif
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Progres</label>
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped @if ($wk->progres == 100) bg-success
                                                                    @elseif ($wk->progres >= 50)
                                                                    bg-warning
                                                                    @elseif($wk->progres < 50)
                                                                    bg-danger @endif"
                                                                    role="progressbar"
                                                                    style="width: {{ $wk->progres }}%;"
                                                                    aria-valuenow="{{ $wk->progres }}" aria-valuemin="0"
                                                                    aria-valuemax="100">{{ $wk->progres }}%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            style="width: 6rem">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editModal-{{ $wk->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                        {{ $wk->created_at->format('d-M-Y') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="btn-close"></button>
                                                </div>
                                                <form onsubmit="$('#submit').prop('disabled',true)"
                                                    action="/weekly/update/{{ $wk->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Mulai Kegiatan</label>
                                                            <input class="form-control mb-4 mb-md-0" name="start_date"
                                                                data-inputmask="'alias': 'datetime'"
                                                                data-inputmask-inputformat="yyyy-mm-dd HH:MM:ss"
                                                                autocomplete="off" value="{{ $wk->start_date }}"
                                                                required />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Selesai Kegiatan</label>
                                                            <input class="form-control mb-4 mb-md-0" name="end_date"
                                                                data-inputmask="'alias': 'datetime'"
                                                                data-inputmask-inputformat="yyyy-mm-dd HH:MM:ss"
                                                                autocomplete="off" value="{{ $wk->end_date }}"
                                                                required />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Rencana</label>
                                                            <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4" name="rencana" maxlength="2500"
                                                                rows="6" required>{{ $wk->rencana }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            style="width: 6rem">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/slider/js/slider.js') }}" rel="stylesheet"></script> --}}
    <script>
        const mySlider = document.getElementById("my-slider");
        const sliderValue = document.getElementById("slider-value");

        function slider() {
            const valPercent = (mySlider.value / mySlider.max) * 100;
            mySlider.style.background = `linear-gradient(to right, #06980e ${valPercent}%, #d5d5d5 ${valPercent}%)`;
            sliderValue.textContent = mySlider.value + "%";
        }

        function updateProgress() {
            const status = document.getElementById("exampleFormControlSelect1");
            const progresInput = document.getElementById("my-slider");

            if (status.value == 0) {
                progresInput.value = 20;
            } else if (status.value == 1) {
                progresInput.value = 100;
            } else if (status.value == 2) {
                progresInput.value = 0;
            }

            if (progresInput.value > 0 && progresInput.value < 100) {
                status.value = 0;
            } else if (progresInput.value == 100) {
                status.value = 1;
            } else if (progresInput.value == 0) {
                status.value = 2;
            }

            status.dispatchEvent(new Event('change'));
            slider();
        }

        slider(); // Panggil fungsi slider saat halaman dimuat
    </script>

    <script>
        @if (Session::has('success'))
            window.onload = () => showSwal('mixin', '{{ Session::get('success') }}')
        @endif

        document.querySelectorAll('form[name="delete"]').forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault()
                Swal.fire({
                    title: 'Apa anda yakin?',
                    text: "Setelah data dihapus, data tidak bisa dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit()
                    }
                });
            });
        });
    </script>
@endpush
