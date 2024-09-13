<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tel_no',
        'nic',
        'address',
        'town',
        'state',
        'post_code',
        'status'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
