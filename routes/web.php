<?php


use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

// in terminal, use php artisan make:controller UserController

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


// All Listings
// the 'index' is the name of the function in the ListingController file
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
// this needs to be above '/listings/{listing}' to not mess up the routes
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data - POST API link
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::patch('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'delete'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show Register Form
// the middleware('guest') is to redirect an already logged in user back
// to the home page, and to control the home page link go
// to app > Providers > RouteServiceProvider.php and edit HOME link
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

// Register User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
// the name('login') is necessary for app > Http > Middleware > Authenticate.php
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Login User
Route::post('/users/login', [UserController::class, 'authenticate']);
