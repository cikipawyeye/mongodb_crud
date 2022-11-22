@extends('layouts.template')

@section('content')

    @if ($book != null)
        <h3>{{ $book->title }}</h3>
        <p>by {{ $book->writer }}</>
        
        <div class="row p-4 rounded-5" style="background-color: rgb(215, 215, 215)">
            <div class="col-md-4">
                <p>Publisher</p>
                <p>Release Year</p>
            </div>
            <div class="col-md-1">
                <p>:</p>
                <p>:</p>
            </div>
            <div class="col-md-7">
                <p><strong>{{ $book->publisher }}</strong></p>
                <p><strong>{{ $book->year }}</strong></p>
            </div>
        </div>

    @else
        <h2 class="mt-3 text-center">No data found!</h2>
    @endif

@endsection
