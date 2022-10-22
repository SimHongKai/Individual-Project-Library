<?php

use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManageBookController;
use App\Http\Controllers\Admin\ManageMaterialController;
use App\Http\Controllers\Admin\ManageRewardController;
use App\Http\Controllers\Admin\ManageConfigurationController;
use App\Http\Controllers\Admin\BorrowBookController;
use App\Http\Controllers\Admin\BorrowHistoryController;
use App\Http\Controllers\Admin\RewardHistoryController;

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

// Debug View Only, Remember to Comment out TODO
Route::get('/debug', [RecommendationController::class, 'getRecommendationsISBN'])->name('debug');

Route::get('/', function () {
    return view('home');
});

// Display Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Display Catalog
Route::get('/catalog', [BookController::class, 'index'])->name('catalog');

// Book Details View
Route::get('/book_details/{ISBN}', [BookController::class, 'bookDetailsView'])->name('book_details');


// Display Catalog Search
Route::get('/catalog_search', [BookController::class, 'searchCatalogView'])->name('catalog_search');
// Submit Catalog Search
Route::get('/catalog_filtered', [BookController::class, 'searchCatalog'])->name('catalog_search_submit');


// Authentication Routes, Login, Register, etc
Auth::routes();

// All Routes which needs account to access
Route::middleware('auth')->group(function(){
    // Bookmark
    Route::post('/add_bookmark', [BookmarkController::class, 'addBookmark'])->name('add_bookmark');
    // Bookmark
    Route::post('/delete_bookmark', [BookmarkController::class, 'deleteBookmark'])->name('delete_bookmark');

    // Make Booking
    Route::get('/create_booking/{ISBN}', [BookingController::class, 'createBooking'])->name('create_booking');
    // Cancel Booking
    Route::get('/cancel_booking/{bookingID}', [BookingController::class, 'cancelBooking'])->name('cancel_booking');

    // Reward Shop view
    Route::get('/reward_shop', [RewardController::class, 'index'])->name('reward_shop');
    // Redeem Reward
    Route::get('/redeem_reward/{reward_id}', [RewardController::class, 'redeemReward'])->name('redeem_reward');

    // Leaderboard View
    Route::get('/leaderboard', [LeaderboardController::class, 'totalLeaderboardView'])->name('leaderboard');
    Route::get('/weekly_leaderboard', [LeaderboardController::class, 'weeklyLeaderboardView'])->name('weekly_leaderboard');

    // Default Profile View - Bookmarks
    Route::get('/profile/bookmarks', [ProfileController::class, 'bookmarkView'])->name('profile');
    // Profile - Bookings
    Route::get('/profile/bookings', [ProfileController::class, 'bookingHistoryView'])->name('profile_bookings');
    // Profile - Borrow History
    Route::get('/profile/borrow', [ProfileController::class, 'borrowHistoryView'])->name('profile_borrows');
    // Profile - Reward History
    Route::get('/profile/rewards', [ProfileController::class, 'rewardHistoryView'])->name('profile_rewards');

    // Claim Daily Points
    Route::get('/profile/claim_daily', [ProfileController::class, 'claimDaily'])->name('claim_daily');
});

// All Routes which needs admin privilige to access
Route::middleware('authAdmin')->group(function(){
    
    // Admin View
    Route::get('/admin_panel', [AdminController::class, 'adminPanelView'])->name('admin_panel');

    // Manage Books View
    Route::get('/manage_books', [ManageBookController::class, 'index'])->name('manage_books');
    // Book Details View
    Route::get('/manage_book_details/{ISBN}', [ManageBookController::class, 'manageBookDetailsView'])->name('manage_book_details');
    // Display Catalog Search
    Route::get('/manage_books_search', [ManageBookController::class, 'searchCatalogView'])->name('admin_catalog_search');
    // Submit Catalog Search
    Route::get('/manage_books_filtered', [ManageBookController::class, 'searchCatalog'])->name('admin_catalog_search_submit');
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
    // Borrow Booked Book Form
    Route::get('/borrow_booked_book', [BorrowBookController::class, 'borrowBookedBookView'])->name('borrow_booked_book');
    // Borrow Book Submit
    Route::post('/borrow_book', [BorrowBookController::class, 'borrowBook'])->name('borrow_book_submit');
    // Route for XMLHttp Requests using fetch for Borrow Book Details
    Route::post('/borrow_book/get-user', [BorrowBookController::class, 'getUser'])->name('borrow_book_get_user');
    Route::post('/borrow_book/get-material', [BorrowBookController::class, 'getMaterial'])->name('borrow_book_get_material');
    Route::post('/borrow_booked_book/get-booking', [BorrowBookController::class, 'getBooking'])->name('borrow_book_get_booking');

    // Return Book Form
    Route::get('/return_book', [BorrowBookController::class, 'returnBookView'])->name('return_book');
    // Return Book Submit
    Route::post('/return_book', [BorrowBookController::class, 'returnBook'])->name('return_book_submit');
    // Route for XMLHttp Requests using fetch for Return Book Details
    Route::post('/return_book/get-return-details', [BorrowBookController::class, 'getReturnDetails'])->name('get_return_details');

    // Borrow Records Views
    Route::get('/admin_borrow_records', [BorrowHistoryController::class, 'index'])->name('admin_borrow_records');
    // Booking Records Views
    Route::get('/admin_booking_records', [BookingController::class, 'index'])->name('admin_booking_records');
     // Booking Record - Booked Only Views
     Route::get('/admin_booked_only_records', [BookingController::class, 'bookedOnlyView'])->name('admin_booked_only_records');
     // Booking Record - Booked Only Views
     Route::get('/admin_booked_material_records', [BookingController::class, 'bookedWithMaterialView'])->name('admin_booked_material_records');
    // Reward Records Views
    Route::get('/admin_reward_records', [RewardHistoryController::class, 'index'])->name('admin_reward_records');
    // Unclaimed Reward Records Views
    Route::get('/admin_unclaimed_rewards', [RewardHistoryController::class, 'unclaimedRewardView'])->name('admin_unclaimed_rewards');
    // Claim Reward
    Route::get('/claim_reward/{reward_history_id}', [ManageRewardController::class, 'claimRewardRedemption'])->name('claim_reward');
    // Cancel Reward
    Route::get('/cancel_reward/{reward_history_id}', [ManageRewardController::class, 'cancelRewardRedemption'])->name('cancel_reward');

    // Reward List Views
    Route::get('/manage_rewards', [ManageRewardController::class, 'index'])->name('manage_rewards');
    // Add Reward Form
    Route::get('/add_reward', [ManageRewardController::class, 'addRewardView'])->name('add_reward');
    // Add Reward Submit
    Route::post('/add_reward', [ManageRewardController::class, 'addReward'])->name('add_reward_submit');
    // Edit Reward Form
    Route::get('/edit_reward/{reward_id}', [ManageRewardController::class, 'editRewardView'])->name('edit_reward');
    // Edit Reward Submit
    Route::post('/edit_reward', [ManageRewardController::class, 'editReward'])->name('edit_reward_submit');
    // Delete Reward Submit
    Route::get('/delete_reward/{reward_id}', [ManageRewardController::class, 'deleteReward'])->name('delete_reward');
    // Claim Reward Form
    Route::get('/claim_reward', [ManageRewardController::class, 'claimRewardView'])->name('claim_reward_view');
    // Claim Reward Submit
    Route::post('/claim_reward', [ManageRewardController::class, 'claimReward'])->name('claim_reward_submit');
    // Route for XMLHttp Requests using fetch for Claim Reward Details
    Route::post('/claim_reward/get-claim-details', [RewardHistoryController::class, 'getClaimRewardDetails'])->name('get_claim_details');

    // Edit Config Form
    Route::get('/edit_configuration', [ManageConfigurationController::class, 'editConfigurationView'])->name('edit_configuration');
    // Edit Confid Form Submit
    Route::post('/edit_configuration', [ManageConfigurationController::class, 'editConfiguration'])->name('edit_configuration_submit');
});


