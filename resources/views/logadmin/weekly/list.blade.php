@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Weekly</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat Progres Kegiatan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('cetak-pdf') }}" method="GET">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex inline  mb-3 me-2">
                                    <input type="date" class="form-control" name="start_date">

                                    <div><i class="link-icon icon-sm mt-3 mx-2" data-feather="minus"></i></div>
                                    <input type="date" class="form-control" name="end_date">


                                </div>
                                {{-- <div class="d-flex justify-content-end"> --}}
                                <button type="submit" class="btn btn-danger btn-icon-text mb-3"><i class="btn-icon-prepend"
                                        data-feather="printer"></i>Cetak PDF</button>
                                {{-- </div> --}}
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;"> No </th>
                                    <th style="width:1rem;"> Tgl Laporan </th>
                                    <th style="width:1rem;">Divisi</th>
                                    <th style="width:1rem;"> Tanggal Kegiatan</th>
                                    <th>Rencana Kegiatan</th>
                                    <th style="width:1rem;">Status</th>
                                    <th style="width:1rem;">Progres</th>
                                    {{-- <th style="width:1rem;"> Aksi </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($weekly as $wk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $wk->created_at->format('d-M-Y') }}</td>
                                        <td>{{ $wk->akundivisi->divisi->divisi }}</td>
                                        <td>{{ \Carbon\Carbon::parse($wk->start_date)->format('d-M-Y') }}
                                        </td>
                                        <td><?php
                                        $num_char = 60;
                                        $text = $wk->rencana;
                                        echo substr($text, 0, $num_char) . '...';
                                        ?></td>
                                        <td>
                                            @if ($wk->status == 0)
                                                <span class="badge bg-warning text-white">Berjalan</span>
                                            @elseif($wk->status == 1)
                                                <span class="badge bg-success text-white">Selesai</span>
                                            @else
                                                <span class="badge bg-danger text-white">Tidak Selesai</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped
                                                @if ($wk->progres == 100) bg-success
                                                 @elseif ($wk->progres >= 50)
                                                 bg-warning
                                                 @elseif($wk->progres < 50)
                                                 bg-danger @endif"
                                                    role="progressbar" style="width: {{ $wk->progres }}%;"
                                                    aria-valuenow="{{ $wk->progres }}" aria-valuemin="0"
                                                    aria-valuemax="100">{{ $wk->progres }}%</div>
                                            </div>
                                        </td>
                                        {{-- <td class="d-flex inline">
                                            <button type="button"
                                                class="btn btn-inverse-secondary btn-xs btn-icon"data-bs-toggle="modal"
                                                data-bs-target="#viewModal-{{ $wk->id }}"><i data-feather="eye"
                                                    class="icon-sm"></i></button>
                                            <form name="delete" action="{{ route('weekly.delete', $wk) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-inverse-danger btn-xs btn-icon ms-2"
                                                    data-id="{{ $wk->id }}"><i data-feather="trash"
                                                        class="icon-sm"></i></button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                    <!-- Modal -->
                                    {{-- <div class="modal fade" id="viewModal-{{ $wk->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                    {{ $wk->tgl_bp }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">{{ $wk->user->nm_depan }}
                                                        {{ $wk->user->nm_belakang }}</label> <br>
                                                    {{ $wk->user->divisi->divisi }} <br>
                                                    {{ $wk->user->nohp }} <br>
                                                    {{ $wk->user->email }}
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Waktu Kegiatan</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $wk->wkt_mulai }} - {{ $wk->wkt_selesai }}" required
                                                        readonly style="background-color: #f5f5f5" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Rencana</label>
                                                    <textarea class="form-control" maxlength="2500" rows="7" readonly style="background-color: #f5f5f5;">{{ $wk->rencana }}</textarea>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Aktual</label>
                                                    <textarea class="form-control" maxlength="2500" rows="7" readonly style="background-color: #f5f5f5;">{{ $wk->aktual }}</textarea>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Progres</label>
                                                    <span class="badge bg-success"
                                                        style="width: 100%">{{ $wk->progres }}%</span>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Foto</label>
                                                    <img src="{{ asset($wk->foto) }}" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
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
