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
            <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $sub }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form onsubmit="$('#submit').prop('disabled',true)" action="{{ route('akundivisi.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-0" class="col-form-label">Divisi</label>
                            </div>
                            <div class="col-lg-9 inline">
                                <input class="form-control me-2" maxlength="255" value="{{ $divisi->divisi }}"
                                    type="text" autocomplete="off" readonly disabled style="background-color: #f5f5f5">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-0" class="col-form-label">Username</label>
                            </div>
                            <div class="col-lg-9 inline">
                                <input class="form-control me-2" maxlength="255" name="username" type="text"
                                    placeholder="Username" autocomplete="off" style="width: 50%" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-0" class="col-form-label">Password</label>
                            </div>
                            <div class="col-lg-9 inline">
                                <div class="input-group" style="width: 50%">
                                    <input class="form-control me-2" maxlength="255" name="password" type="password"
                                        placeholder="*********" autocomplete="off" required>
                                    <button type="button" onclick="togglePasswordVisibility()"
                                        class="input-group-text input-group-addon"><i data-feather="eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Hak Akses</label>
                            </div>
                            <div class="col-lg-9 inline">
                                <select class="form-select" id="exampleFormControlSelect1" name="id_level"
                                    style="width: 30%" required>
                                    {{-- <option selected value="">-- Pilih --</option> --}}
                                    @foreach ($level as $lv)
                                        @if ($lv->id === 2)
                                            <option selected value="{{ $lv->id }}">{{ $lv->level }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-lg-8">
                                <input class="form-control" maxlength="50" name="id_divisi" value={{ $divisi->id }}
                                    id="defaultconfig-3" type="text" required hidden>
                            </div>
                        </div>
                        <div class="my-2 d-flex justify-content-between">
                            <a href="{{ url('/divisi/list') }}" type="button" class="btn btn-secondary me-2"
                                style="width: 6rem">Kembali</a>
                            <button type="submit" class="btn btn-primary" style="width: 6rem">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementsByName("password")[0];
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
@endpush
