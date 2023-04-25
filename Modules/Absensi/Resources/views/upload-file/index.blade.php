@extends('layouts.app')

@section('content')
<div class="content pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="m-0 align-self-center"><i class="fas fa-cloud-upload-alt mr-2"></i>Upload File Absensi</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-info">
                            Dengan ini saya <strong>{{ $user->name }}</strong> Kasubbag. UMPEG pada <strong>{{ $user->opd->nama }}</strong> menyatakan daftar hadir peserta sudah diisi dengan lengkap.
                        </p>
                        <p class="text-danger">
                            Mohon untuk menjadi perhatian, setelah file absensi diupload update daftar hadir sudah tidak bisa dilakukan lagi.
                        </p>
                        @include('components.flash-alert')
                        <form action="{{ route('absensi.upload-file.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <input type="file" name="file_absensi" class="form-control @error('file_absensi') is-invalid @enderror" accept="application/pdf" style="padding: .2rem">
                                        @error('file_absensi')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        @isset($user->opd->file_absensi)
                        <embed src="{{ asset("storage/{$user->opd->file_absensi}") }}" width="100%" height="500px">
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection