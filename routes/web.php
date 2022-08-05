<?php

use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManageBookController;
use App\Http\Controllers\Admin\ManageMaterialController;
use App\Http\Controllers\Admin\BorrowBookController;
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
    Route::get('/add_book', [ManageBookController::class, 'addBookView'])->name('add_book');
    // Add Book Form Submit
    Route::post('/add_book', [ManageBookController::class, 'addBook'])->name('add_book_submit');
    // Edit Book View
    Route::get('/edit_book/{ISBN}', [ManageBookController::class, 'editBookView'])->name('edit_book');
    // Edit Book Submit
    Route::post('/edit_book', [ManageBookController::class, 'editBook'])->name('edit_book_submit');
    // Remove Book
    Route::get('/remove_book/{ISBN}', [ManageBookController::class, 'deleteBook'])->name('remove_book');

    // Add Material View
    Route::get('/add_material/{ISBN}', [ManageMaterialController::class, 'addMaterialView'])->name('add_material');
    // Add Material Form Submit
    Route::post('/add_material', [ManageMaterialController::class, 'addMaterial'])->name('add_material_submit');
    // Edit Material View
    Route::get('/edit_material/{material_no}', [ManageMaterialController::class, 'editMaterialView'])->name('edit_material');
    // Edit Material Submit
    Route::post('/edit_material', [ManageMaterialController::class, 'editMaterial'])->name('edit_material_submit');
    // Remove Material
    Route::get('/remove_material/{material_no}', [ManageMaterialController::class, 'deleteMaterial'])->name('remove_material');

    // Borrow Book Form
    Route::get('/borrow_book', [BorrowBookController::class, 'borrowBookView'])->name('borrow_book');
    // Borrow Book Submit
    Route::post('/borrow_book', [BorrowBookController::class, 'borrowBook'])->name('borrow_book_submit');
    // Route for XMLHttp Requests using fetch
    Route::post('/borrow_book/get-user', [BorrowBookController::class, 'getUser'])->name('borrow_book_get_user');
    Route::post('/borrow_book/get-material', [BorrowBookController::class, 'getMaterial'])->name('borrow_book_get_material');

    // Return Book Form
    Route::get('/return_book', [BorrowBookController::class, 'returnBookView'])->name('return_book');
    // Return Book Submit
    Route::post('/return_book', [BorrowBookController::class, 'returnBook'])->name('return_book_submit');
    // Route for XMLHttp Requests using fetch
    Route::post('/return_book/get-return-details', [BorrowBookController::class, 'getReturnDetails'])->name('get_return_details');

    // Records Views
    Route::get('/admin_borrow_records', [BorrowHistoryController::class, 'index'])->name('admin_borrow_records');
});


