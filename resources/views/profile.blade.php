@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title ?? 'Profile Saya' }}</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-4 text-center">
                    <form action="{{ url('/profile/update-foto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Label sebagai pemicu input file -->
                        <label for="foto" style="cursor: pointer;">
                            <img src="{{ asset('uploads/' . Auth::user()->foto) }}" 
                                 alt="Foto Profil" 
                                 class="img-thumbnail rounded-circle mb-3 hover-shadow"
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        </label>
                
                        <!-- Input file disembunyikan -->
                        <input type="file" name="foto" id="foto" class="d-none" accept="image/*" onchange="this.form.submit()">
                    </form>
                
                    <small class="text-muted d-block mt-2">Klik foto untuk mengganti</small>
                </div>
                
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th>Username</th>
                            <td>: {{ Auth::user()->username }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>: {{ Auth::user()->nama }}</td>
                        </tr>
                        <tr>
                            <th>Level</th>
                            <td>: {{ Auth::user()->level->level_nama ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .img-thumbnail {
            border: 2px solid #007bff;
        }
    </style>
@endpush