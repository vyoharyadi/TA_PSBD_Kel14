<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RentLogsController;
use App\Http\Controllers\BooklistController;
use App\Http\Controllers\BookRentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registering']);

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('only_user')->group(function () {
            Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::get('booklist', [BooklistController::class, 'index'])->name('booklist.index');
        Route::get('booklist/search', [BooklistController::class, 'search'])->name('booklist.search');
    });

    Route::middleware('only_admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::get('/books/deleted', [BookController::class, 'deletedBooks'])->name('books.deleted');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
        Route::patch('/books/{id}/delete', [BookController::class, 'delete'])->name('books.delete');
        Route::patch('/books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
        Route::delete('/books/{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.forceDelete');


        Route::get('categories', [CategoryController::class, 'index']);
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::patch('/users/{id}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::patch('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
        Route::patch('/users/{id}/unban', [UserController::class, 'unban'])->name('users.unban');
        Route::get('/users/inactive', [UserController::class, 'showInactive'])->name('users.inactive');
        Route::get('/users/banned', [UserController::class, 'showBanned'])->name('users.banned');

        Route::get('book-rent', [BookRentController::class, 'index']);
        Route::post('book-rent', [BookRentController::class, 'store']);

        Route::get('rent-logs', [RentLogsController::class, 'index']);
    });
});
