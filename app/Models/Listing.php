<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// cmd + click "Model" to see all the methods
class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {

        if (($filters['tag']) ?? false) {
            // the period dots are concatenating
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
    }
}
