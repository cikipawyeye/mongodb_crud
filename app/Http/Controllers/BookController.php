<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'books' => Book::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book', [
            'book' => Book::where('slug', '=', $book->slug)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $slug = $request->title . '-' . $request->writer . '-' . 
        $request->publisher . '-' . $request->year;

        $slug = rtrim($slug, "/");
        $slug = filter_var($slug, FILTER_SANITIZE_URL);
        $slug = str_replace(['?', '/', '&', '*', '#', '.', '[', ']', '{', '}', '+', '=', '@'], '', strtolower($slug));

        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->publisher = $request->publisher;
        $book->year = $request->year;
        $book->slug = str_replace(' ', '-', $slug);
        $book->save();

        return redirect('/book')->with('success', 'Update data success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/book')->with('success', 'Deleting data success!');
    }
}
