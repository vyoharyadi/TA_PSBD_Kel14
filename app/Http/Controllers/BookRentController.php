<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->where('status', 'active')->get();
        $books = Book::all();
        return view('bookrent', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'action' => 'required|in:rent,return',
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $userId = $request->user_id;
        $bookId = $request->book_id;
        $action = $request->action;

        if ($action == 'rent') {
            // --- RENT PROCESS ---
            $book = Book::findOrFail($bookId);

            if ($book->status != 'available') {
                Session::flash('message', 'Cannot rent, the book is not available!');
                Session::flash('alert-class', 'alert-danger');
                return redirect('book-rent');
            }

            $activeRents = RentLogs::where('user_id', $userId)
                ->whereNull('actual_return_date')
                ->count();

            if ($activeRents >= 3) {
                Session::flash('message', 'Cannot rent, user has reached the rent limit!');
                Session::flash('alert-class', 'alert-danger');
                return redirect('book-rent');
            }

            try {
                DB::beginTransaction();

                RentLogs::create([
                    'user_id' => $userId,
                    'book_id' => $bookId,
                    'rent_date' => Carbon::now()->toDateString(),
                    'return_date' => Carbon::now()->addDays(7)->toDateString(),
                    'status' => 'borrowed',
                ]);

                $book->status = 'not available';
                $book->save();

                DB::commit();

                Session::flash('message', 'Rent book success!');
                Session::flash('alert-class', 'alert-success');
            } catch (\Throwable $th) {
                DB::rollBack();
                Session::flash('message', 'Error while renting book!');
                Session::flash('alert-class', 'alert-danger');
            }

            return redirect('book-rent');

        } elseif ($action == 'return') {
            // --- RETURN PROCESS ---
            $rentLog = RentLogs::where('user_id', $userId)
                ->where('book_id', $bookId)
                ->whereNull('actual_return_date')
                ->first();

            if (!$rentLog) {
                Session::flash('message', 'No active rental found for this user and book!');
                Session::flash('alert-class', 'alert-danger');
                return redirect('book-rent');
            }

            try {
                DB::beginTransaction();

                $rentLog->actual_return_date = Carbon::now()->toDateString();
                $rentLog->status = 'returned';
                $rentLog->save();

                $book = Book::findOrFail($bookId);
                $book->status = 'available';
                $book->save();

                DB::commit();

                Session::flash('message', 'Book returned successfully!');
                Session::flash('alert-class', 'alert-success');
            } catch (\Throwable $th) {
                DB::rollBack();
                Session::flash('message', 'Error while returning book!');
                Session::flash('alert-class', 'alert-danger');
            }

            return redirect('book-rent');
        }
    }
}
