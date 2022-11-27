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
        return view('book/index', [
            'books' => Book::all()
        ]);
    }

    /**
     * Displays search results for the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($params)
    {
        if ($params == "" | $params == null) {
            return redirect('/book');
        } else {
            return view('book/index', [
                'books' => Book::where('title', 'like', "%$params%")->orWhere('writer', 'like', "%$params%")->get(),
                'search' => $params
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'writer' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|numeric|digits:4',
        ]);

        $book = new Book;
        
        $slug = $validatedData['title'] . '-' . $validatedData['writer'] . '-' . 
        $validatedData['publisher'] . '-' . $validatedData['year'];

        $slug = rtrim($slug, "/");
        $slug = filter_var($slug, FILTER_SANITIZE_URL);
        $slug = str_replace(['?', '/', '&', '*', '#', '.', '[', ']', '{', '}', '+', '=', '@'], '', strtolower($slug));

        $book->title = $validatedData['title'];
        $book->writer = $validatedData['writer'];
        $book->publisher = $validatedData['publisher'];
        $book->year = $validatedData['year'];
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
        return view('book/show', [
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
        return view('book/edit', ['book' => $book]);
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
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'writer' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|numeric|digits:4',
        ]);

        $slug = $validatedData['title'] . '-' . $validatedData['writer'] . '-' . 
        $validatedData['publisher'] . '-' . $validatedData['year'];

        $slug = rtrim($slug, "/");
        $slug = filter_var($slug, FILTER_SANITIZE_URL);
        $slug = str_replace(['?', '/', '&', '*', '#', '.', '[', ']', '{', '}', '+', '=', '@'], '', strtolower($slug));

        $book->title = $validatedData['title'];
        $book->writer = $validatedData['writer'];
        $book->publisher = $validatedData['publisher'];
        $book->year = $validatedData['year'];
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
