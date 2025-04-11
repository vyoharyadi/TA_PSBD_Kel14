<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $userCount = User::where('status', 'active')->count();
        $categoryCount = Category::count();

        $rentlogs = RentLogs::all();

        return view('dashboard', ['book_count' => $bookCount, 'user_count' => $userCount, 'category_count' => $categoryCount, 'rent_logs' => $rentlogs]);
    }
}
