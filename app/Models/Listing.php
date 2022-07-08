<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// cmd + click "Model" to see all the methods
class Listing extends Model
{
    use HasFactory;
    // have to include fillable fields here if 
    // in Providers > AppServiceProvider, Model::unguard() is commented
    protected $fillable = [
        'title', 'company', 'location',
        'website', 'email', 'description', 'tags', 'logo', 'user_id'
    ];

    public function scopeFilter($query, array $filters)
    {

        if (($filters['tag']) ?? false) {
            // the period dots are concatenating
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if (($filters['search']) ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
