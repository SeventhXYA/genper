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
                    <form onsubmit="$('#submit').prop('disabled',true)" action="{{ route('monitoring.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-0" class="col-form-label">Program</label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="maxlength-textarea" maxlength="2500" rows="3" name="program"
                                    placeholder="Program" autocomplete="off" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-0" class="col-form-label">Keterangan</label>
                            </div>
                            <div class="col-lg-3 ">
                                <select class="form-select" id="exampleFormControlSelect1" name="keterangan" required>
                                    <option selected hidden disabled>--Pilih--</option>
                                    <option value="0">Progress</option>
                                    <option value="1">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-0" class="col-form-label">Output</label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="maxlength-textarea-1" maxlength="2500" rows="3" name="output"
                                    placeholder="Output" autocomplete="off" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-lg-3">
                                <label for="defaultconfig-0" class="col-form-label">Outcome</label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control"id="maxlength-textarea-2" maxlength="2500" rows="3" name="outcome"
                                    placeholder="Outcome" autocomplete="off" required></textarea>
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
        })

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
    <script>
        function selectChange() {
            var selectElement = document.getElementById("pelaksana-select");
            var textInput = document.getElementById("defaultconfig-text");

            if (selectElement.value !== "-- Pilih --") {
                textInput.value = "";
                textInput.disabled = true;
            } else {
                textInput.disabled = false;
            }
        }
    </script>
    <script>
        function textInputChange() {
            var selectElement = document.getElementById("pelaksana-select");
            var textInput = document.getElementById("defaultconfig-text");

            if (textInput.value !== "") {
                selectElement.disabled = true;
            } else {
                selectElement.disabled = false;
            }
        }
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            // Mengambil elemen input RAB
            const rabInput = document.getElementById('rab');

            // Mengubah nilai input RAB menjadi format mata uang Rupiah
            const formattedRab = 'Rp ' + new Intl.NumberFormat('id-ID').format(0);

            // Mengisi nilai input RAB dengan format mata uang Rupiah
            rabInput.value = formattedRab;

            // Mengambil elemen input Realisasi
            const realisasiInput = document.getElementById('realisasi');

            // Mengubah nilai input Realisasi menjadi format mata uang Rupiah
            const formattedRealisasi = 'Rp ' + new Intl.NumberFormat('id-ID').format(0);

            // Mengisi nilai input Realisasi dengan format mata uang Rupiah
            realisasiInput.value = formattedRealisasi;
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        const selectElement = document.querySelector('#pelaksana');
        const otherInput = document.getElementById('otherInput');

        selectElement.addEventListener('change', function() {
            if (selectElement.value === 'other') {
                otherInput.style.display = 'block';
                otherInput.setAttribute('required', 'required');
            } else {
                otherInput.style.display = 'none';
                otherInput.removeAttribute('required');
            }
        });
    </script>
@endpush
