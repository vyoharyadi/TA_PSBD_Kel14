<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('categories')->where('status', '!=', 'deleted')->get();
        $categories = Category::all();
        return view('books', compact('books', 'categories'));
    }

    public function deletedBooks()
    {
        $books = Book::with('categories')->where('status', 'deleted')->get();
        $categories = Category::all();
        return view('books', compact('books', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_code' => 'required|unique:books',
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'image' => 'required',
            'description' => 'required',
            'categories' => 'required|array|min:1',
        ]);

        $book = new Book();
        $book->book_code = $request->book_code;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;
        $book->image = $request->image;
        $book->description = $request->description;
        $book->status = 'available';
        $book->save();

        $book->categories()->sync($request->categories);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'book_code' => 'required|unique:books,book_code,' . $id,
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'image' => 'required',
            'description' => 'required',
            'categories' => 'required|array|min:1',
        ]);

        $book->book_code = $request->book_code;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;
        $book->image = $request->image;
        $book->description = $request->description;
        $book->save();

        $book->categories()->sync($request->categories);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diupdate');
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);

        $book->categories()->detach();

        $book->update(['status' => 'deleted']);

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }

    public function restore($id)
    {
        $book = Book::findOrFail($id);
        $book->update(['status' => 'available']);

        return redirect()->route('books.deleted')->with('success', 'Buku berhasil direstore');
    }

    public function forceDelete($id)
    {
        $book = Book::findOrFail($id);
        $book->categories()->detach(); // hapus relasi
        $book->delete(); // jika pakai soft delete
        $book->forceDelete(); // hapus permanen dari DB

        return redirect()->route('books.deleted')->with('success', 'Buku berhasil dihapus permanen');
    }
}
