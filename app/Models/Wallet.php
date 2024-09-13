<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email', 'tel_no', 'credentials', 'editor_data', 'note', 'status'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
