<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPost extends Model
{
     use HasFactory;
 protected $fillable = [
        'title',
        'company',
        'location',
        'type',
        'category',
        'salary',
        'description',
        'requirements', // Added missing
        'image', // Added missing
        'pdf', // Added missing
        'publishdate',
        'dateline',
        'is_active', // Added missing
        'category_id'
    ];

    protected $casts = [
        'requirements' => 'array',
        'publishdate' => 'date',
        'dateline' => 'date',
        'is_active' => 'boolean'
    ];

    // Relationship with Category
     public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Scopes for common queries
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeExpired($query)
    {
        return $query->where('dateline', '<', now());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('publishdate', '>', now());
    }

    public function scopeCurrent($query)
    {
        return $query->where(function($q) {
            $q->whereNull('publishdate')
              ->orWhere('publishdate', '<=', now());
        })->where(function($q) {
            $q->whereNull('dateline')
              ->orWhere('dateline', '>=', now());
        });
    }
}
