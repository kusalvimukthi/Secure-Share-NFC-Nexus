<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StorageTag extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_details', 'manufactured_date', 'expiration_date', 'avatar', 'product_name', 'product_weight','status'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
