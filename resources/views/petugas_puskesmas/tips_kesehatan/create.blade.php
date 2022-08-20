@extends('layouts-admin.master')
@section('title 1')
Formulir Tambah Tips Kesehatan
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">
<link rel="stylesheet" href="{{asset('arfa/vendor/izitoast/dist/css/iziToast.min.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        Pengelolaan Tips Kesehatan
    </div>

    <div class="card">
        <div class="card-header">
            <h4>@yield('title 1')</h4>
        </div>

        @if(Session::get('succes'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <form action="{{route('tips.store')}}" method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate="" autocomplete="off">

                @csrf

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Judul Tips</label>
                        <input class="form-control" type="text" placeholder="Masukan Judul" aria-label="default input example" name="judul_tips" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Judul tips kesehatan tidak boleh kosong
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Tips Kesehatan</label>
                        <textarea name="keterangan" id="summernote" cols="30" rows="10"></textarea>

                        <div class="invalid-feedback">
                            baris ini tidak boleh kosong
                        </div>
                    </div>


                    <a href="{{route('tips.index')}}" class="btn btn-light btn-sm me-2"><i class="me-2 ti-arrow-left"></i>Kembali</a>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="me-2 ti-save"></i> Simpan
                    </button>

                </div>
            </form>
        </div>
    </div>

</div>





@endsection
@push('js')
<script src="{{asset('arfa/assets/js/login.js')}}"></script>
<script src="{{asset('arfa/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('arfa/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('arfa/vendor/izitoast/dist/js/iziToast.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $('#summernote').summernote({
        placeholder: 'Tulis Artikel Disini...',
        tabsize: 2,
        height: 400
    });
</script>
@endpush










