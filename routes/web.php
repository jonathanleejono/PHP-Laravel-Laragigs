<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;

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
Route::get('/listings/create', [ListingController::class, 'create']);

// Store Listing Data - POST API link
Route::post('/listings', [ListingController::class, 'store']);

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);
