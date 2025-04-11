<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentLogs;
use Illuminate\Support\Facades\DB;

class RentLogsController extends Controller
{

public function index()
{
    $rentlogs = DB::table('rent_logs')
        ->join('users', 'rent_logs.user_id', '=', 'users.id')
        ->join('books', 'rent_logs.book_id', '=', 'books.id')
        ->select(
            'rent_logs.id',
            'rent_logs.rent_date',
            'rent_logs.return_date',
            'rent_logs.actual_return_date',
            'rent_logs.status',

            'users.username',
            'users.email',
            'users.phone',
            'users.address',

            'books.book_code',
            'books.title',
            'books.author',
            'books.year',
            'books.image',
            'books.description'
        )
        ->get();

    return view('rentlogs', ['rent_logs' => $rentlogs]);
}


}
