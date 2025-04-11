<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BooklistController extends Controller
{
    public function index()
    {
        $books = Book::with('categories')->where('status', '!=', 'deleted')->get();
        $categories = Category::all();
        return view('booklist', compact('books', 'categories'));
    }

    public function search(Request $request)
    {
        $query = Book::with('categories')->where('status', '!=', 'deleted');
        $categories = Category::all();
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $books = $query->get();

        return view('booklist', compact('books', 'categories'));
    }
}
