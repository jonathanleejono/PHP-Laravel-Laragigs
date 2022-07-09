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
        // die dump, kind of like console.log (but in browser)
        // dd(Listing::latest()->filter(request([
        //     'tag',
        //     'search'
        // ]))->paginate(2));

        // the view parameter is the name of the file
        // inside of resources > views > listings > index.blade.php
        return view('listings.index', [
            // 'listings' => Listing::all()
            'listings' => Listing::latest()->filter(request([
                'tag',
                'search'
            ]))->paginate(6)
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

        if ($request->hasFile('logo')) {
            // inside config > filesystems.php
            // 'default' => env('FILESYSTEM_DISK', 'public')
            // set the second param of env() to be 'public' to upload files
            $formFields['logo'] = $request->file('logo')->store("logos", 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data 
    public function update(Request $request, Listing $listing)
    {
        // the dd (dye dump?) does an in browser console.log
        // dd($request->all());

        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store("logos", 'public');
        }

        $listing->update($formFields);

        return redirect('/')->with('message', 'Listing updated successfully!');
    }

    // Delete Listing
    public function delete(Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    // Manage Listings
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
