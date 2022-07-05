<?php

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
Route::get('/', function () {
    // the view parameter is the name of the file
    // inside of resources > views > listings.php
    return view('listings', [
        'heading' => 'Latest Listings',
        'listings' => Listing::all()
    ]);
});


// Single Listing1
Route::get('/listings/{listing}', function (Listing $listing) {
    return view('listing', [
        // keep both of these as singular 'listing'
        'listing' => $listing
    ]);
});
