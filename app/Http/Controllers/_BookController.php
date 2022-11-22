<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //

    public function getSingle($slug)
    {
        return view('book', [
            'book' => Book::where('slug', '=', $slug)->first()
        ]);
    }

    public function showAll() {
        return view('home', [
            'books' => Book::all()
        ]);
    }

    public function destroy($slug) {

        $book = Book::where('slug', $slug)->first();
        $book->delete();

        return redirect('/book')->with('success', 'Deleting data success!');
    }

    public function update(Request $request, $slug) {

        $book = Book::where('slug', $slug)->first();
        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->publisher = $request->publisher;
        $book->year = $request->year;
        $book->slug = str_replace(' ', '-', strtolower($slug));
        $book->save();

        return redirect('/book')->with('success', 'Update data success!');
    }

    public function store(Request $request)
    {
        $book = new Book;

        $slug = $request->title . '-' . $request->writer . '-' . 
        $request->publisher . '-' . $request->year;

        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->publisher = $request->publisher;
        $book->year = $request->year;
        $book->slug = str_replace(' ', '-', strtolower($slug));

        $book->save();

        return redirect('/book')->with('success', 'Adding data success!');
    }
}
