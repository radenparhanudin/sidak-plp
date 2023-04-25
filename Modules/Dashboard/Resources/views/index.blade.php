@extends('layouts.app')

@section('content')
<div class="content pt-3">
    <div class="container-fluid">
        @include('components.flash-alert')
        <div class="row">
            <div class="col-12 col-sm-5">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                        <h5 class="widget-user-desc">{{ Auth::user()->username }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ asset('template/backend') }}/dist/img/user1-128x128.jpg" alt="User Avatar">
                    </div>
                    <div class="card-footer text-center">
                        <div class="description-block">
                            <h5 class="description-header mb-1">HAK AKSES</h5>
                            <span class="description-text" style="text-transform: none">{{ $roles }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-7">
                @hasrole('administrator')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('dashboard.set-token-siasn') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="token_siasn" class="form-control @error('token_siasn') is-invalid @enderror" value="{{ session('token_siasn') }}" placeholder="Token SIASN">
                                @error('token_siasn')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-spider mr-1"></i>Submit</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('dashboard.ubah-password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Baru">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-spider mr-1"></i>Ubah Password</button>
                        </form>
                    </div>
                </div>
                @endhasrole
            </div>
        </div>
    </div>
</div>
@endsection