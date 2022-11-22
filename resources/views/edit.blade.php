@extends('layouts.template')

@section('content')
    <h3 class="mb-3">Edit a book: {{ $book->title }}</h3>
    <form action="/book/{{ $book->slug }}" method="post">
        @method('put')
        @csrf

        <label for="" class="mb-2">Title</label>
        <div class="input-group mb-3">
            <input type="text" name="title" class="form-control" placeholder="Masukkan Judul" aria-label="Username"
                value="{{ $book->title }}" aria-describedby="basic-addon1">
        </div>
        <label for="" class="mb-2">Writer</label>
        <div class="input-group mb-3">
            <input type="text" name="writer" class="form-control" placeholder="Masukkan Penulis" aria-label="Username"
                value="{{ $book->writer }}" aria-describedby="basic-addon1">
        </div>
        <label for="" class="mb-2">Publisher</label>
        <div class="input-group mb-3">
            <input type="text" name="publisher" class="form-control" placeholder="Masukkan Penerbit"
                value="{{ $book->publisher }}" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <label for="" class="mb-2">Release Year</label>
        <div class="input-group mb-3">
            <input type="number" name="year" class="form-control" placeholder="Masukkan Tahun" aria-label="Username"
                value="{{ $book->year }}" aria-describedby="basic-addon1">
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-light me-2 border border-dark" type="button" onclick="history.back()">Cancel</button>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
        {{-- {{ Form::close() }} --}}
    </form>
@endsection
