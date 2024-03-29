@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/plugins/slider/css/slider.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Self-Development</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Baru</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <span class="badge bg-success card-title">
                        <h6>Buat Laporan Baru</h6>
                    </span>
                    <form onsubmit="$('#submit').prop('disabled',true)" action="/selfdevelopment/update/{{ $dailysd->id }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-0" class="col-form-label">Tanggal Kegiatan</label>
                            </div>
                            <div class="col-lg-8">
                                <div class="input-group date">
                                    <input type="text" class="form-control"name="tgl_sd"
                                        value="{{ $dailysd->tgl_sd }}">
                                    <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-0" class="col-form-label">Waktu Kegiatan</label>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group date timepicker" id="datetimepickerExample"
                                    data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="wkt_mulai"
                                        value="{{ $dailysd->wkt_mulai }}" data-target="#datetimepickerExample" />
                                    <span class="input-group-text" data-target="#datetimepickerExample"
                                        data-toggle="datetimepicker"><i data-feather="clock"></i></span>
                                </div>
                            </div>
                            s/d
                            <div class="col-lg-3">
                                <div class="input-group date timepicker" id="datetimepickerExample2"
                                    data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        name="wkt_selesai"value="{{ $dailysd->wkt_selesai }}"
                                        data-target="#datetimepickerExample2" />
                                    <span class="input-group-text" data-target="#datetimepickerExample2"
                                        data-toggle="datetimepicker"><i data-feather="clock"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig" class="col-form-label">Rencana</label>
                            </div>
                            <div class="col-lg-8">
                                <textarea id="maxlength-textarea" class="form-control" id="defaultconfig" maxlength="500" rows="8" name="rencana"
                                    placeholder="This textarea has a limit of 500 chars.">{{ $dailysd->rencana }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig" class="col-form-label">Aktual</label>
                            </div>
                            <div class="col-lg-8">
                                <textarea id="maxlength-textarea-2" class="form-control" id="defaultconfig" maxlength="500" rows="8"
                                    name="aktual" placeholder="This textarea has a limit of 500 chars.">{{ $dailysd->aktual }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig" class="col-form-label">Progres</label>
                            </div>
                            <div class="col-lg-8">
                                <div class="container">
                                    <input type="range" id="my-slider" min="0" max="100"
                                        value="{{ $dailysd->progres }}" name="progres" oninput="slider()">
                                    <div id="slider-value">{{ $dailysd->progres }}</div>
                                </div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Upload Dokumentasi</label>
                            </div>
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    {{-- <label class="form-label" for="formFile">File upload</label> --}}
                                    <input class="form-control" type="file" accept="image/*" name="foto"
                                        id="pict">
                                    <div id="preview" class="my-3"
                                        style="aspect-ratio: 4/3; background-image: url({{ asset($dailysd->foto) }});background-color:rgb(196, 196, 196);background-size: cover;scroll-snap-align: center;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" style="width: 6rem">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('my-slider').addEventListener('input', (event) => {
            const magnitude = 5
            const value = Math.round(event.target.value / magnitude) * magnitude

            event.target.value = value
            document.getElementById('slider-value').textContent = value + '%'
        });

        document.getElementById('pict').addEventListener('change', function() {
            const [file] = document.getElementById('pict').files;
            document.getElementById('preview').style.backgroundImage = 'url(' + URL.createObjectURL(file) + ')';
        });
    </script>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('assets/plugins/slider/js/slider.js') }}" rel="stylesheet"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush
