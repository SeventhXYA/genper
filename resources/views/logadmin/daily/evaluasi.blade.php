@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Evaluasi Harian</a></li>
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
                                    <th style="width:28rem;"> Evaluasi </th>
                                    <th style="width:1rem;"> Aksi </th>
                                </tr>
                            </thead>
                            @foreach ($dailyev as $ev)
                                <tbody>
                                    <tr>
                                        <td>{{ $ev->created_at->format('d-M-Y') }}</td>
                                        <td>{{ $ev->user->nm_depan }} {{ $ev->user->nm_belakang }}</td>
                                        <td>{{ $ev->user->divisi->divisi }}</td>
                                        <td>
                                            <?php
                                            $num_char = 60;
                                            $text = $ev->dailyevaluate;
                                            if (strlen($text) > $num_char) {
                                                $text = substr($text, 0, $num_char) . '...';
                                            }
                                            echo $text;
                                            ?>
                                        </td>
                                        <td class="d-flex inline">
                                            <button type="button"
                                                class="btn btn-outline-secondary btn-xs btn-icon"data-bs-toggle="modal"
                                                data-bs-target="#viewModal-{{ $ev->id }}"><i data-feather="eye"
                                                    class="icon-sm"></i></button>
                                            <form name="delete" action="{{ route('evaluasi.delete', $ev) }}"
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-xs btn-icon ms-2"
                                                    data-id="{{ $ev->id }}"><i data-feather="trash"
                                                        class="icon-sm"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Modal -->
                                <div class="modal fade" id="viewModal-{{ $ev->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                    {{ $ev->tgl_ev }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">{{ $ev->user->nm_depan }}
                                                        {{ $ev->user->nm_belakang }}</label> <br>
                                                    {{ $ev->user->divisi->divisi }} <br>
                                                    {{ $ev->user->nohp }} <br>
                                                    {{ $ev->user->email }}
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Evaluasi</label>
                                                    <textarea class="form-control" maxlength="1000" rows="20" readonly style="background-color: #f5f5f5;">{{ $ev->dailyevaluate }}</textarea>
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
                    @foreach ($dailyevMobile as $ev)
                        <div class="d-inline d-md-none">
                            <div class="card my-2" style="border-width: 2px;">
                                <div
                                    class="card-header d-flex justify-content-between"style="background-color: white; border:none">
                                    <b>{{ $ev->created_at->format('d-M-Y') }}</b>
                                </div>
                                <div class="card-body" style="background-color: white; border:none">
                                    <label class="form-label fw-bold">{{ $ev->user->nm_depan }}
                                        {{ $ev->user->nm_belakang }}</label><br>
                                    {{ $ev->user->divisi->divisi }} <br> <br>
                                    <?php
                                    $num_char = 100;
                                    $text = $ev->dailyevaluate;
                                    if (strlen($text) > $num_char) {
                                        $text = substr($text, 0, $num_char) . '...';
                                    }
                                    echo $text;
                                    ?>
                                </div>
                                <div class="card-footer d-flex justify-content-end"
                                    style="background-color: white; border:none">

                                    <button type="button"
                                        class="btn btn-outline-secondary btn-icon btn-xl"data-bs-toggle="modal"
                                        data-bs-target="#viewModalMobile-{{ $ev->id }}"><i data-feather="eye"
                                            class="icon-xl"></i></button>
                                    <form name="delete" action="{{ route('evaluasi.delete', $ev) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-xl btn-icon ms-2"
                                            data-id="{{ $ev->id }}"><i data-feather="trash"
                                                class="icon-xl"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="viewModalMobile-{{ $ev->id }}" tabindex="-1"
                            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                            {{ $ev->tgl_ev }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">{{ $ev->user->nm_depan }}
                                                {{ $ev->user->nm_belakang }}</label> <br>
                                            {{ $ev->user->divisi->divisi }} <br>
                                            {{ $ev->user->nohp }} <br>
                                            {{ $ev->user->email }}
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Evaluasi</label>
                                            <textarea class="form-control" maxlength="1000" rows="20" readonly style="background-color: #f5f5f5;">{{ $ev->dailyevaluate }}</textarea>
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
                    {{ $dailyevMobile->links() }}

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
