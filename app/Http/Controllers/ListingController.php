<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index()
    {
        // the view parameter is the name of the file
        // inside of resources > views > listings > index.blade.php
        return view('listings.index', [
            // 'listings' => Listing::all()
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    // Show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            // keep both of these as singular 'listing'
            'listing' => $listing
        ]);
    }

    // Create listing 
    public function create()
    {
        return view('listings.create');
    }

    // Store Listing Data 
    public function store(Request $request)
    {
        // the dd (dye dump?) does an in browser console.log
        // dd($request->all());

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($formFields);

        return redirect('/');
    }
}