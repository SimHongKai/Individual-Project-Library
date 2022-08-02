<?php

use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManageBookController;
use App\Http\Controllers\Admin\BorrowHistoryController;

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
    return view('home');
});

// Display Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Display Catalog
Route::get('/catalog', [BookController::class, 'index'])->name('catalog');

// Authentication Routes, Login, Register, etc
Auth::routes();


// All Routes which needs admin privilige to access
Route::middleware('authAdmin')->group(function(){
    
    // Admin View
    Route::get('/admin_panel', [AdminController::class, 'adminPanelView'])->name('admin_panel');

    // Manage Books View
    Route::get('/manage_books', [ManageBookController::class, 'index'])->name('manage_books');
    // Book Details View
    Route::get('/manage_book_details/{ISBN}', [ManageBookController::class, 'bookDetailsView'])->name('manage_book_details');
    // Add Book View
    Route::get('/add_book', [ManageBookController::class, 'addBooksView'])->name('add_book');
    // Add Book Form Submit
    Route::post('/add_book', [ManageBookController::class, 'addBook'])->name('add_book_submit');

    // Records Views
    Route::get('/admin_borrow_records', [BorrowHistoryController::class, 'index'])->name('admin_borrow_records');
});


