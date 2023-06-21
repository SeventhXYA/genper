@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Self-Development</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat Laporan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive d-none d-md-inline">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:5rem;"> Tgl Laporan </th>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th style="width:24rem;"> Plan </th>
                                    <th> Progres </th>
                                    <th style="width:1rem;"> Aksi </th>
                                </tr>
                            </thead>
                            @foreach ($dailysd as $sd)
                                <tbody>
                                    <tr>
                                        <td>{{ $sd->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $sd->user->nm_depan }} {{ $sd->user->nm_belakang }}</td>
                                        <td>{{ $sd->user->divisi->divisi }}</td>
                                        <td>
                                            <?php
                                            $num_char = 40;
                                            $text = $sd->rencana;
                                            if (strlen($text) > $num_char) {
                                                $text = substr($text, 0, $num_char) . '...';
                                            }
                                            echo $text;
                                            ?>
                                        </td>
                                        <td><span class="badge bg-success" style="width: 6rem">{{ $sd->progres }}%</span>
                                        </td>
                                        <td class="d-flex inline">
                                            <button type="button"
                                                class="btn btn-inverse-secondary btn-xs btn-icon"data-bs-toggle="modal"
                                                data-bs-target="#viewModal-{{ $sd->id }}"><i data-feather="eye"
                                                    class="icon-sm"></i></button>
                                            <form name="delete" action="{{ route('dailysd.delete', $sd) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-inverse-danger btn-xs btn-icon ms-2"
                                                    data-id="{{ $sd->id }}"><i data-feather="trash"
                                                        class="icon-sm"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Modal -->
                                <div class="modal fade" id="viewModal-{{ $sd->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                    {{ $sd->tgl_sd }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">{{ $sd->user->nm_depan }}
                                                        {{ $sd->user->nm_belakang }}</label> <br>
                                                    {{ $sd->user->divisi->divisi }} <br>
                                                    {{ $sd->user->nohp }} <br>
                                                    {{ $sd->user->email }}
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Waktu Kegiatan</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $sd->wkt_mulai }} - {{ $sd->wkt_selesai }}" required
                                                        readonly style="background-color: #f5f5f5" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Rencana</label>
                                                    <textarea class="form-control" maxlength="2500" rows="7" readonly style="background-color: #f5f5f5;">{{ $sd->rencana }}</textarea>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Aktual</label>
                                                    <textarea class="form-control" maxlength="2500" rows="7" readonly style="background-color: #f5f5f5;">{{ $sd->aktual }}</textarea>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Progres</label>
                                                    <span class="badge bg-success"
                                                        style="width: 100%">{{ $sd->progres }}%</span>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Foto</label>
                                                    <img src="{{ asset($sd->foto) }}" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </table>
                    </div>
                    @foreach ($dailysdMobile as $sd)
                        <div class="d-inline d-md-none">
                            <div class="card my-2" style="border-width: 2px;">
                                <div
                                    class="card-header d-flex justify-content-between"style="background-color: white; border:none">
                                    <b>{{ $sd->created_at->format('Y-m-d') }}</b> <span class="badge bg-success my-auto"
                                        style="width: 6rem">{{ $sd->progres }}%</span>
                                </div>
                                <div class="card-body" style="background-color: white; border:none">
                                    <label class="form-label fw-bold">{{ $sd->user->nm_depan }}
                                        {{ $sd->user->nm_belakang }}</label><br>
                                    {{ $sd->user->divisi->divisi }} <br> <br>
                                    <?php
                                    $num_char = 40;
                                    $text = $sd->rencana;
                                    if (strlen($text) > $num_char) {
                                        $text = substr($text, 0, $num_char) . '...';
                                    }
                                    echo $text;
                                    ?>
                                </div>
                                <div class="card-footer d-flex justify-content-end"
                                    style="background-color: white; border:none">
                                    <button type="button"
                                        class="btn btn-inverse-secondary btn-icon btn-xl"data-bs-toggle="modal"
                                        data-bs-target="#viewModalMobile-{{ $sd->id }}"><i data-feather="eye"
                                            class="icon-xl"></i></button>
                                    <form name="delete" action="{{ route('dailysd.delete', $sd) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-inverse-danger btn-xl btn-icon ms-2"
                                            data-id="{{ $sd->id }}"><i data-feather="trash"
                                                class="icon-xl"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="viewModalMobile-{{ $sd->id }}" tabindex="-1"
                            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                            {{ $sd->tgl_sd }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">{{ $sd->user->nm_depan }}
                                                {{ $sd->user->nm_belakang }}</label> <br>
                                            {{ $sd->user->divisi->divisi }} <br>
                                            {{ $sd->user->nohp }} <br>
                                            {{ $sd->user->email }}
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Waktu Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $sd->wkt_mulai }} - {{ $sd->wkt_selesai }}" required readonly
                                                style="background-color: #f5f5f5" />
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Rencana</label>
                                            <textarea class="form-control" maxlength="255" rows="7" readonly style="background-color: #f5f5f5;">{{ $sd->rencana }}</textarea>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Aktual</label>
                                            <textarea class="form-control" maxlength="255" rows="7" readonly style="background-color: #f5f5f5;">{{ $sd->aktual }}</textarea>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Progres</label>
                                            <span class="badge bg-success"
                                                style="width: 100%">{{ $sd->progres }}%</span>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Foto</label>
                                            <img src="{{ asset($sd->foto) }}" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $dailysdMobile->links() }}

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
