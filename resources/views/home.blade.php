@extends('layouts.template')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-md-10">
            <h3 class="mb-3">List of Books</h3>
        </div>
        <div class="col-md-2 d-flex justify-content-end">
            <a href="/book/create"><button class="btn btn-primary">Add Data</button> </a>
        </div>
    </div>

    @if (count($books) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Writer</th>
                    <th scope="col">Publisher</th>
                    <th scope="col">Year</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><a class="text-decoration-none" href="/book/{{ $book->slug }}">{{ $book->title }}</a></td>
                        <td>{{ $book->writer }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->year }}</td>
                        <td>
                            <a href="/book/{{ $book->slug }}/edit"><span class="fs-6 badge text-bg-light border border-1"><i
                                        class="bi-pencil-square"></i></span></a>
                            {{-- triger modal --}}
                            <a href="#" id="btn-delete" slug="{{ $book->slug }}" title="{{ $book->title }}"
                                data-bs-toggle="modal" data-bs-target="#deleteBookModal"><span
                                    class="fs-6 text-danger badge text-bg-light border border-1"><i
                                        class="bi-trash"></i></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete this book?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-message">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="#" id="form-delete" method="POST">
                            @method('delete')
                            @csrf
                            <input type="hidden" id="input-slug" value="">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            let button = document.querySelectorAll('#btn-delete');

            button.forEach(element => {
                element.addEventListener('click', function() {
                    let slug = element.getAttribute('slug');
                    let title = element.getAttribute('title');
                    let url = "/book/" + slug;

                    console.log(slug)
                    document.getElementById('form-delete').setAttribute('action', url);
                    document.getElementById('input-slug').setAttribute('value', slug);
                    document.getElementById('modal-message').innerHTML = "Are you sure want to remove '" +
                        title +
                        "'?";
                })
            })
        </script>
    @else
        <h3 class="text-center">No data found!</h3>
    @endif
@endsection
