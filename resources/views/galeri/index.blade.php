@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Galeri DLH Papua Barat</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <a href="{{ route('galeri.download') }}" class="btn btn-primary mb-3">Download Gambar dari DLH</a>

    <div class="row">
        @forelse($files as $file)
            <div class="col-md-3 mb-4">
                <img src="{{ asset('storage/' . $file) }}" class="img-fluid rounded shadow" alt="Galeri Image">
            </div>
        @empty
            <p>Tidak ada gambar.</p>
        @endforelse
    </div>
</div>
@endsection
