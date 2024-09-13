<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_id',
        'name',
        'tel_no',
        'email',
        'address',
        'company_name',
        'designation',
        'avatar',
        'bio',
        'social_links',
        'status'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
