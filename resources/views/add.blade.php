@extends('layouts.template')

@section('content')
    <h3 class="mb-3">Add a book</h3>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="/book" method="POST">
        @csrf

        <label for="" class="mb-2">Title</label>
        <div class="input-group mb-3">
            <input type="text" name="title" class="form-control" placeholder="Masukkan Judul" aria-label="Username"
                aria-describedby="basic-addon1">
        </div>
        <label for="" class="mb-2">Writer</label>
        <div class="input-group mb-3">
            <input type="text" name="writer" class="form-control" placeholder="Masukkan Penulis" aria-label="Username"
                aria-describedby="basic-addon1">
        </div>
        <label for="" class="mb-2">Publisher</label>
        <div class="input-group mb-3">
            <input type="text" name="publisher" class="form-control" placeholder="Masukkan Penerbit"
                aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <label for="" class="mb-2">Release Year</label>
        <div class="input-group mb-3">
            <input type="number" name="year" class="form-control" placeholder="Masukkan Tahun" aria-label="Username"
                aria-describedby="basic-addon1">
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-light me-2 border border-dark" type="button" onclick="history.back()">Cancel</button>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
@endsection
