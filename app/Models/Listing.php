<?php

namespace App\Models;

class Listing
{
    public static function all()
    {
        return [
            [
                'id' => 1,
                'title' => 'Listing One',
                'description' => 'Here is where you can register web routes for your application. These
                routes are loaded by the RouteServiceProvider within a group which
                contains the "web" middleware group. Now create something great!'
            ],
            [
                'id' => 2,
                'title' => 'Listing 2',
                'description' => 'Here is where you can register web routes for your application. These
                routes are loaded by the RouteServiceProvider within a group which
                contains the "web" middleware group. Now create something great!'
            ],
        ];
    }


    // find
    public static function find($id)
    {
        $listings = self::all();

        foreach ($listings as $listing) {
            if ($listing['id'] == $listing) {
                return $listing;
            }
        }
    }
}
