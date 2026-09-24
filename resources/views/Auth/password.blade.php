@extends('layouts.app')

@section('title', 'Ganti Password')
@section('page-title', 'Ganti Password')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-6 col-md-8 col-sm-12">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="mb-4">

                        <h4 class="fw-bold mb-1">
                            Ganti Password
                        </h4>

                        <p class="text-muted mb-0">
                            Ubah password akun Anda secara berkala
                            untuk menjaga keamanan akun.
                        </p>

                    </div>


                    {{-- Success --}}

                    @if(session('success'))

                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>

                    @endif


                    {{-- Error --}}

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <i class="bi bi-exclamation-circle me-2"></i>

                            Periksa kembali data yang dimasukkan.

                        </div>

                    @endif

                    <form
                        action="{{ route('password.update') }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        {{-- Password Baru --}}

                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label fw-semibold"
                            >
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Minimal 8 karakter"
                                required
                            >

                            @error('password')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Konfirmasi Password --}}

                        <div class="mb-4">

                            <label
                                for="password_confirmation"
                                class="form-label fw-semibold"
                            >
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password baru"
                                required
                            >

                        </div>


                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="bi bi-shield-lock me-1"></i>
                                Simpan Password
                            </button>

                            <a
                                href="{{ url()->previous() }}"
                                class="btn btn-light border"
                            >
                                Batal
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection